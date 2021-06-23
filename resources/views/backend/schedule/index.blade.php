

@section('title', 'Tài khoản')
@extends('backend.layouts.master')
@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="row">
   <div class="col-md-12">
      @include('backend.layouts.notification')
   </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="card-body">
<div class="table-responsive">
   <div class="row">
      <div class="col">
         <div class="collapse panel-collapse show collapse-stock" id="CNPC">
            <div class="card">
               <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="m-0 font-weight-bold text-primary float-left">Hệ thống sắp xếp ca làm</h4>
                   </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                    <div id="lnb">
                        <div class="lnb-new-schedule">
                            <button id="btn-new-schedule" type="button" class="btn btn-default btn-block lnb-new-schedule-btn" data-toggle="modal">
                                New schedule</button>
                        </div>
                        <div id="lnb-calendars" class="lnb-calendars">
                            <div>
                                <div class="lnb-calendars-item">
                                    <label>
                                        <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked>
                                        <span></span>
                                        <strong>View all</strong>
                                    </label>
                                </div>
                            </div>
                            <div id="calendarList" class="lnb-calendars-d1">
                            </div>
                        </div>
                        <div class="lnb-footer">
                            © NHN Corp.
                        </div>
                    </div>
                    <div id="right">
                        <div id="menu">
                            <span class="dropdown">
                                <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true">
                                    <i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
                                    <span id="calendarTypeName">Dropdown</span>&nbsp;
                                    <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                                    <li role="presentation">
                                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                                            <i class="calendar-icon ic_view_day"></i>Daily
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                                            <i class="calendar-icon ic_view_week"></i>Weekly
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                                            <i class="calendar-icon ic_view_month"></i>Month
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2">
                                            <i class="calendar-icon ic_view_week"></i>2 weeks
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3">
                                            <i class="calendar-icon ic_view_week"></i>3 weeks
                                        </a>
                                    </li>
                                    <li role="presentation" class="dropdown-divider"></li>
                                    <li role="presentation">
                                        <a role="menuitem" data-action="toggle-workweek">
                                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
                                            <span class="checkbox-title"></span>Show weekends
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a role="menuitem" data-action="toggle-start-day-1">
                                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1">
                                            <span class="checkbox-title"></span>Start Week on Monday
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a role="menuitem" data-action="toggle-narrow-weekend">
                                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend">
                                            <span class="checkbox-title"></span>Narrower than weekdays
                                        </a>
                                    </li>
                                </ul>
                            </span>
                            <span id="menu-navi">
                                <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
                                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                                    <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                                    <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                                </button>
                            </span>
                            <span id="renderRange" class="render-range"></span>
                        </div>
                        <div id="calendar"></div>
                    </div>
                  </div>
                  <div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalShowPermisson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title-permission"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" value="" id="role_id">
            <ul class="ks-cboxtags" id="list-permission">
                
            </ul>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary" onclick="updatePermission()">Chỉnh sửa</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('styles')

{{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" /> --}}
    <style>

    </style>
    <link href="{{asset('css/list-checkbox.css')}}" rel="stylesheet">
    <link href="{{asset('css/tui-calendar.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/css/util.css')}}" rel="stylesheet">

@endpush
@push('scripts')
    <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
    <script src="https://uicdn.toast.com/tui.time-picker/v2.0.3/tui-time-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui.date-picker/v4.0.3/tui-date-picker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chance/1.0.13/chance.min.js"></script>
    <script src="{{ asset('js/shift.js') }}"></script>
    <script src="{{ asset('js/tui-calendar.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>
    <script src="{{ asset('js/schedule.js') }}"></script>
    <script>
       
        
    </script>
@endpush

