<!-- jQuery -->
<script src="{{ url('public/js/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ url('public/js/bootstrap.min.js') }}"></script>
<script src="{{ url('public/js/jqBootstrapValidation.js') }}"></script>
<!-- Theme JavaScript -->
<script src="{{ url('public/js/clean-blog.min.js') }}"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('public/js/jquery.bootcomplete.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#txt_search_india').bootcomplete({
      		url:'/tourlocations',
			minLength : 1
    		});
	});
</script>

@yield('page_js')


<!-- begin olark code -->
<!--<script type="text/javascript" async>
;(function(o,l,a,r,k,y){if(o.olark)return;
r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0];
y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r);
y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)};
y.extend=function(i,j){y("extend",i,j)};
y.identify=function(i){y("identify",k.i=i)};
y.configure=function(i,j){y("configure",i,j);k.c[i]=j};
k=y._={s:[],t:[+new Date],c:{},l:a};
})(window,document,"static.olark.com/jsclient/loader.js");
olark.identify('6205-696-10-9726');</script>-->
<!-- end olark code -->