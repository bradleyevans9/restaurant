<?php

namespace App\Http\Controllers;

use App\Charts\RetreatOfferingChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('show-dashboard');
        return view('dashboard.index');
    }

    public function agc($number_of_years = 5)
    {
        $this->authorize('show-dashboard');
        return view('dashboard.agc',compact('number_of_years'));
    }

    public function donation_description_chart($donation_description = 'Retreat Funding')
    {
      $this->authorize('show-dashboard');
      $descriptions = \App\Models\DonationType::active()->orderBy('name')->pluck('name', 'name');

      return view('dashboard.description',compact('donation_description','descriptions'));
  }

    public function events($year = null)
    {
        // TODO: Create donut chart for average number of retreatants per event (get count of event_type_id) partipants/count(event_type_id) //useful for Ambassador goal of 40 (draw goal line)
        $this->authorize('show-dashboard');

        // default to current fiscal year
        if (! isset($year)) {
            $year = (date('m') > 6) ? date('Y') + 1 : date('Y');
        }

        $current_year = (date('m') > 6) ? date('Y') + 1 : date('Y');
        $prev_year = $year - 1;
        $begin_date = $prev_year.'-07-01';
        $end_date = $year.'-07-01';

        $number_of_years = 5;
        $years = [];
        for ($x = 0; $x <= $number_of_years; $x++) {
            $today = \Carbon\Carbon::now();
            $today->day = 1;
            $today->month = 1;
            $today->year = $current_year;
            $years[$x] = $today->subYear($x);
        }

        // TODO: using role_id = 5 as hardcoded value - explore how to use config('polanco.participant_role_id.retreatant') instead
        $event_summary = DB::select("SELECT tmp.type, tmp.type_id, SUM(tmp.pledged) as total_pledged, SUM(tmp.paid) as total_paid, SUM(tmp.participants) as total_participants, SUM(tmp.peoplenights) as total_pn, SUM(tmp.nights) as total_nights
            FROM
            (SELECT e.id as event_id, e.title as event, et.name as type, et.id as type_id, e.idnumber, e.start_date, e.end_date, DATEDIFF(e.end_date,e.start_date) as nights,
            	(SELECT SUM(d.donation_amount) FROM Donations as d WHERE d.event_id=e.id AND d.deleted_at IS NULL) as pledged,
            	(SELECT SUM(p.payment_amount) FROM Donations as d LEFT JOIN Donations_payment as p ON (p.donation_id = d.donation_id) WHERE d.event_id=e.id AND d.deleted_at IS NULL AND p.deleted_at IS NULL) as paid,
            	(SELECT COUNT(*) FROM participant as reg WHERE reg.event_id = e.id AND reg.deleted_at IS NULL AND reg.canceled_at IS NULL AND reg.role_id IN (5,11) AND reg.status_id IN (1)) as participants,
            	(SELECT(participants*nights)) as peoplenights
            FROM event as e LEFT JOIN event_type as et ON (et.id = e.event_type_id)
            WHERE e.start_date > :begin_date AND e.start_date < :end_date AND e.is_active=1 AND e.deleted_at IS NULL AND e.title NOT LIKE '%Deposit%'
            GROUP BY e.id) as tmp
            GROUP BY tmp.type
            ORDER BY `tmp`.`type` ASC", [
            'begin_date' => $begin_date,
            'end_date' => $end_date,
        ]);

        $total_revenue = array_sum(array_column($event_summary, 'total_paid'));
        $total_participants = array_sum(array_column($event_summary, 'total_participants'));
        $total_peoplenights = array_sum(array_column($event_summary, 'total_pn'));

        return view('dashboard.events', compact('years', 'year', 'event_summary', 'total_revenue', 'total_participants', 'total_peoplenights'));
    }

    public function drilldown($event_type_id = null, $year = null)
    {

        // default to current fiscal year
        if (! isset($year)) {
            $year = (date('m') > 6) ? date('Y') + 1 : date('Y');
        }

        $current_year = (date('m') > 6) ? date('Y') + 1 : date('Y');
        $prev_year = $year - 1;
        $begin_date = $prev_year.'-07-01';
        $end_date = $year.'-07-01';
        $event_type = \App\Models\EventType::findOrFail($event_type_id);
        $retreats = \App\Models\Retreat::whereIsActive(1)->whereEventTypeId($event_type_id)->where('start_date', '>=', $begin_date)->where('start_date', '<', $end_date)->orderBy('start_date')->get();

        return view('dashboard.drilldown', compact('event_type', 'year', 'retreats'));
    }
}
