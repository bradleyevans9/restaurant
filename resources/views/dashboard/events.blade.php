@extends('template')
@section('content')

    <section class="section-padding">
        <div class="jumbotron text-left">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <span class="grey">Event Dashboard</span>
                    </h1>
                </div>

                <div class="col-lg-3 col-md-4">
                    <select class="custom-select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                        <option value="">Select fiscal year ...</option>
                        @foreach($years as $y)
                            <option value="{{url('dashboard/events/'.$y->year)}}">FY{{$y->year}}</option>
                        @endForeach
                    </select>
                </div>


                <div>FY{{ $year }} Revenue by Event Type</div>
                <div id="event_revenue" style="height:400px;"></div>
                <div>Total Revenue: ${{ number_format($total_revenue,2) }} </div>
                <hr />

                <div>FY{{ $year }} Participants by Event Type</div>
                <div id="event_participants" style="height:400px;"></div>
                <div>Total Participants: {{ number_format($total_participants,0) }} </div>
                <hr />

                <div>FY{{ $year }} People Nights by Event Type</div>
                <div id="event_peoplenights" style="height:400px;"></div>
                <div>Total People Nights: {{ number_format($total_peoplenights,0) }} </div>
                <hr />

                <div>FY{{ $year }} Summary</div>
                <div>
                    <table class="table table-bordered table-striped table-hover table-responsive-md">
                        <thead style='text-align:center'>
                            <th>Type</th>
                            <th>Pledged</th>
                            <th>Paid</th>
                            <th>Participants</th>
                            <th>Nights</th>
                            <th>People Nights</th>
                            <th>Avg.$/Person/Night</th>
                        </thead>
                        @foreach($event_summary as $category)
                        <tr style='text-align: right'>
                            <td style='text-align: left; font-weight: bold;'><a href="{{ url('dashboard/events/drilldown/'.$category->type_id.'/'.$year) }}">{{ $category->type }}</a></td>
                            <td>${{ number_format($category->total_pledged,2) }}</td>
                            <td>
                                ${{ number_format($category->total_paid,2) }}
                                (
                                @if (array_sum(array_column($event_summary,'total_paid')) > 0)
                                    {{ number_format(((($category->total_paid)/(array_sum(array_column($event_summary,'total_paid'))))*100),0) }}%)
                                @else
                                    N/A
                                @endIf
                            </td>
                            <td>
                                {{ $category->total_participants }}
                                @if (array_sum(array_column($event_summary,'total_participants')) > 0)
                                    ( {{ number_format(((($category->total_participants)/(array_sum(array_column($event_summary,'total_participants'))))*100),0) }}%)
                                @else
                                    N/A
                                @endIf
                            </td>
                            <td>
                                {{ $category->total_nights }}
                            </td>
                            <td>
                                {{ $category->total_pn }}
                                @if (array_sum(array_column($event_summary,'total_pn'))>0)
                                    ( {{ number_format(((($category->total_pn)/(array_sum(array_column($event_summary,'total_pn'))))*100),0) }}%)
                                @else
                                   n/a
                                @endIf
                            </td>
                            <td>
                              @if ($category->total_pn > 0)
                                  ${{ ($category->total_pn>0) ? (number_format(($category->total_paid/$category->total_pn),2)) : '0.00' }}
                              @else
                                  n/a
                              @endIf
                            </td>
                        </tr>
                        @endforeach
                        <tr style='text-align: right; font-weight: bold;'>
                            <td style='text-align: left;'>Total</td>
                            <td>${{ number_format(array_sum(array_column($event_summary,'total_pledged')),2) }}</td>
                            <td>${{ number_format(array_sum(array_column($event_summary,'total_paid')),2) }}</td>
                            <td>{{ number_format(array_sum(array_column($event_summary,'total_participants')),0) }}</td>
                            <td>{{ number_format(array_sum(array_column($event_summary,'total_nights')),0) }}</td>
                            <td>{{ number_format(array_sum(array_column($event_summary,'total_pn')),0) }}</td>
                            <td>
                                @if (array_sum(array_column($event_summary,'total_pn')) > 0)
                                    ${{ number_format((array_sum(array_column($event_summary,'total_paid')))/(array_sum(array_column($event_summary,'total_pn'))),2) }}
                                @else
                                    n/a
                                @endIf
                            </td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

    <script>

        const event_revenue_chart = new Chartisan({
            el: '#event_revenue',
            url: "@chart('event_revenue')" + "?year={{ $year }}",
            hooks: new ChartisanHooks()
              .title('Event Revenue')
              .responsive()
              .legend({ position: 'bottom' })
              .datasets('doughnut')
              .pieColors(["rgba(22,160,133, 0.3)","rgba(51,105,232, 0.3)","rgba(255, 205, 86, 0.3)","rgba(255, 99, 132, 0.3)","rgba(244,67,54, 0.3)"])
              .pieBorderColors(["rgba(22,160,133, 0.6)","rgba(51,105,232, 0.6)","rgba(255, 205, 86, 0.6)","rgba(255, 99, 132, 0.6)","rgba(244,67,54, 0.6)"])
          });

          const event_participants_chart = new Chartisan({
              el: '#event_participants',
              url: "@chart('event_participants')" + "?year={{ $year }}",
              hooks: new ChartisanHooks()
                .title('Event Participants')
                .responsive()
                .legend({ position: 'bottom' })
                .datasets('doughnut')
                .pieColors(["rgba(22,160,133, 0.3)","rgba(51,105,232, 0.3)","rgba(255, 205, 86, 0.3)","rgba(255, 99, 132, 0.3)","rgba(244,67,54, 0.3)"])
                .pieBorderColors(["rgba(22,160,133, 0.6)","rgba(51,105,232, 0.6)","rgba(255, 205, 86, 0.6)","rgba(255, 99, 132, 0.6)","rgba(244,67,54, 0.6)"])
            });

            const event_peoplenights_chart = new Chartisan({
                el: '#event_peoplenights',
                url: "@chart('event_peoplenights')" + "?year={{ $year }}",
                hooks: new ChartisanHooks()
                  .title('Event People Nights')
                  .responsive()
                  .legend({ position: 'bottom' })
                  .datasets('doughnut')
                  .pieColors(["rgba(22,160,133, 0.3)","rgba(51,105,232, 0.3)","rgba(255, 205, 86, 0.3)","rgba(255, 99, 132, 0.3)","rgba(244,67,54, 0.3)"])
                  .pieBorderColors(["rgba(22,160,133, 0.6)","rgba(51,105,232, 0.6)","rgba(255, 205, 86, 0.6)","rgba(255, 99, 132, 0.6)","rgba(244,67,54, 0.6)"])
              });

    </script>

@stop
