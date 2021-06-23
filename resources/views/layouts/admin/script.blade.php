<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
  {{--  <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>  --}}
  {{--  <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>  --}}
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>  --}}
  
  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('vendor/js/sb-admin-2.min.js')}}"></script>
   <script src="{{asset('vendor/js/bootstrap-select.js')}}"></script> 
   <script src="{{asset('vendor/js/autoNumeric.min.js')}}"></script> 
   {{-- <script src="{{asset('vendor/js/daterangepicker.js')}}"></script>  --}}
   {{-- <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>  --}}
   <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> 
   {{-- <script type="text/javascript" src="{{ asset('vendor/js/daterangepicker.js') }}"></script>  --}}
  {{-- <script type="text/javascript" src="{{ asset('vendor/js/website.js') }}"></script> --}}
  {{-- <script type="text/javascript" src="{{ asset('vendor/js/vnd.js') }}"></script> --}}
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
   <script src="{{ asset('vendor/js/datatables.min.js') }}"></script> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   
   {{-- <script src="https://cdn.jsdelivr.net/pnotify/2.0.0/pnotify.all.min.js"></script> --}}
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script> --}}
  <script src="https://cdn.datatables.net/select/1.3.2/js/dataTables.select.min.js "></script>
  {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/gijgo.min.js"></script>  --}}
  {{-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>  --}}
  <script src="{{ asset('js/toastr.js') }}"></script> 
  <script src="{{ asset('js/gijgo.js') }}"></script> 
  <script src="{{ asset('vendor/js/vnd.js') }}"></script> 
  <script src='{{ asset("ckeditor/ckeditor.js") }}'></script>
  {{-- <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script> --}}
  <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>     --}}
<script>
  $(window).scroll(function(){
		if($(window).scrollTop() >= 10) {
			$('.button_scroll2top').show();
		} else {
			$('.button_scroll2top').hide();
		}
	});
	
	function page_scroll2top(){
		$('html,body').animate({
			scrollTop: 0
	    }, 'slow');
	}

/* Please ❤ this if you like it! */


(function($) { "use strict";

{{--  $(function() {
    var header = $(".start-style");
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
    
        if (scroll >= 10) {
            header.removeClass('start-style').addClass("scroll-on");
        } else {
            header.removeClass("scroll-on").addClass('start-style');
        }
    });
});		
      --}}
//Animation

$(document).ready(function() {
    $('body.hero-anime').removeClass('hero-anime');
});

//Menu On Hover
    
{{--  $('body').on('mouseenter mouseleave','.nav-item',function(e){
        if ($(window).width() > 750) {
            var _d=$(e.target).closest('.nav-item');_d.addClass('show');
            setTimeout(function(){
            _d[_d.is(':hover')?'addClass':'removeClass']('show');
            },1);
        }
});	  --}}

//Switch light/dark
  {{--  function formatNumber(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
  }
$("#switch").on('click', function () {
    if ($("body").hasClass("dark")) {
        $("body").removeClass("dark");
        $("#switch").removeClass("switched");
    }
    else {
        $("body").addClass("dark");
        $("#switch").addClass("switched");
    }
});    --}}

})(jQuery); 
    </script>
    <script>
      const swal = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })
    var d = new Date($.now());
        now=('0'+d.getHours()).substr(-2)+":"+('0'+d.getMinutes()).substr(-2)+ " "+d.getDate().toString().padStart(2, "0")+"-"+(d.getMonth() + 1).toString().padStart(2, "0")+"-"+d.getFullYear();
        var options = {
            skin: 'office2013',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        var optionsDateTimePicker={
          uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            modal: true,
            footer: true,
            format: 'HH:MM dd-mm-yyyy',
        }
        var optionsNowDateTimePicker={
          uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            modal: true,
            footer: true,
            format: 'HH:MM dd-mm-yyyy',
            value:now,
        }
        </script>
      <script>
        function showError(errors){
        
                        $.each(errors, function(field_name, error) {
                            if (field_name == Object.keys(errors)[0]) {
                                toastr.error(error);
                            }
                        });
        }
        {{--  moment.locale('vi');  --}}
        {{--  $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });
        $('#datetime').datepicker({
          uiLibrary: 'bootstrap4',
          format: "dd-mm-yyyy", 
          iconsLibrary: 'fontawesome',
          value: today,
          modal: true,
          footer: true
      });  --}}
{{--          
        function showUser(e){
          var code=$(e).data('code');
          var url = "{{route('admin.user.show', '')}}"+"/"+code; 
          window.location.href=url;
          
      }  --}}
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        {{--  function formatNumberInput(e){
    
          // skip for arrow keys
          if(event.which >= 37 && event.which <= 40){
            event.preventDefault();
          }
          
          $(e).val(function(index, value) {
            return value
              .replace(/\D/g, "")
              // .replace(/([0-9])([0-9]{2})$/, '$1.$2')  
              .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
            ;
          });
          };  --}}
        {{--  $("#sidebarToggleTop").click();
        setTimeout(function(){
          $('.alert').slideUp();
        },4000);  --}}
        function converValueNumber(e){
          return $(e).val().replace(/\,/g, '');
        }
        function converTextNumber(e){
          return $(e).text().replace(/\,/g, '');
        }
        {{-- $(function() {
        
          var start = moment();
          var end = moment();
       
          function cb(start, end) {
              $('#reportrange1 span').html(start.locale("vi").format('L') + ' - ' + end.format('L'));
              $('#reportrange2 span').html(start.locale("vi").format('L') + ' - ' + end.format('L'));
          }
       
          $('#reportrange1').daterangepicker({
            format: 'YYYY-MM-DD',
              startDate: start,
              endDate: end,
              ranges: {
                 'Hôm nay': [moment().locale("vi"), moment()],
                 'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                 '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                 'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                 'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              }
          }, cb);
          $('#reportrange2').daterangepicker({
            format: 'YYYY-MM-DD',
              startDate: start,
              endDate: end,
              ranges: {
                 'Hôm nay': [moment().locale("vi"), moment()],
                 'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                 '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                 'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                 'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              }
          }, cb);
          cb(start, end);
       
       });
      
    
       $(function() {
    
        var start = moment();
        var end = moment();
    
        function cb(start, end) {
            $('#reportrange-PC span').html(start.locale("vi").format('L') + ' - ' + end.format('L'));
            $('#reportrange-PT span').html(start.locale("vi").format('L') + ' - ' + end.format('L'));
        }
    
        $('#reportrange-PT').daterangepicker({
            format: 'YYYY-MM-DD',
            startDate: start,
            endDate: end,
            ranges: {
                'Hôm nay': [moment().locale("vi"), moment()],
                'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        $('#reportrange-PC').daterangepicker({
            format: 'YYYY-MM-DD',
            startDate: start,
            endDate: end,
            ranges: {
                'Hôm nay': [moment().locale("vi"), moment()],
                'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        cb(start, end);
    
    }); --}}
    {{--  var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    
    today = yyyy+'-'+mm+'-'+dd ;  --}}
    {{--  $('#date').datepicker({
      maxDate: '0',
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome',
      value: today,
      modal: true,
      footer: true,
  });
       --}}
    function decodeEntities(encodedString) {
      var textArea = document.createElement('textarea');
      textArea.innerHTML = encodedString;
      return textArea.value;
    }
    $(document).ready(function () {
      $('#sidebarCollapse').on('click', function () {
          $('#sidebar').toggleClass('active');
      });
  });
  {{--  function keyUpNumber(e) {
    if(e.which >= 37 && e.which <= 40) return;
    $(e).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
}  --}}

  function formatNumber(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
      </script>
      {{-- @routes --}}
      @stack('scripts')