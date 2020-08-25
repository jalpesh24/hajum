@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"> Add New Tour Sightseeing </li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
        <div class="panel-heading" id="headerbg">
         @if (Auth::guest())              
         @else
	     @include('includes.minimenu')              
         @endif 
        </div>
        <div class="panel-body">
        
        <div class="col-md-12">
          <form method="post" name="frm_add_tour_daywise">
            {{ csrf_field() }}
            @for($i = 1; $i <= $tour_detail[0]->days; $i++)
            <div class="col-md-12 form-line">
              <div class="form-group">
                <label for="txt_travel{!! $i !!}">Day {!! $i !!} - Travel</label>
                <input type="text" name="txt_travel{!! $i !!}" id="txt_travel{!! $i !!}" placeholder="Travel {!! $i !!}" class="form-control" required="required"/>
              </div>
              @for($s = 1; $s <=10; $s++)
              <div class="col-md-3 form-line">
                <div class="form-group">
                  <label for="txt_sightseeing{!! $i.'_'.$s !!}">Sight seeings - {!! $s !!}</label>
                  <input type="text" name="txt_sightseeing{!! $i.'_'.$s !!}" id="txt_sightseeing{!! $i.'_'.$s !!}" placeholder="Sight seeing {!! $s !!}" class="form-control" />
                </div>
              </div>
              @endfor
              <div style="clear:both"></div>
             <div class="col-md-6 form-line">
              <div class="form-group">
                <label>Day {!! $i !!} - Meal&nbsp;&nbsp;</label>&nbsp;
                <input type="checkbox" name="chk_meal_{!! $i !!}[]" value="breakfast"/>
                Breakfast&nbsp;&nbsp;
                <input type="checkbox" name="chk_meal_{!! $i !!}[]" value="lunch"/>
                Lunch&nbsp;&nbsp;
                <input type="checkbox" name="chk_meal_{!! $i !!}[]" value="dinner"  />
                Dinner </div>
             </div>
             <div style="clear:both"></div>
              <hr />
            </div>
            @endfor
            <div class="form-group">
              <input type="submit" class="btn btn-primary submit" name="btn_add_tour_daywise" id="btn_add_tour_daywise" value="Save and continue">
            </div>
          </form>
        </div>
        </div>        
      </div>
    </div>
  </div>
</div>
@include('includes.newfooter')
<script src="{{ url('newhtml/js/jquery.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-ui.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-migrate-1.js') }}"></script>
<script src="{{ url('newhtml/js/superfish.js') }}"></script>
<script src="{{ url('newhtml/js/select2.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_002.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_006.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_003.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_007.js') }}"></script>
<script src="{{ url('newhtml/js/scripts.js') }}"></script>
<script src="{{ url('newhtml/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>
