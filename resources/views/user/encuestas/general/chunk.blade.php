<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 
This is a skeleton html file that you can use to get you started on each new 
HTML project

Name: Your Name Here
Class: CIS 3303
Section: x
-->
<html>

<head>
<title>chunk</title>
</head>

<body>
	
	{{-- <div>
		@foreach ($preguntas->chunk(2) as $element)
			<div class="chunk">
				<p>{{ $loop->iteration }}. {{ $element }}</p><br />
			</div>
		@endforeach

	</div> --}}
	@foreach ($preguntas->chunk(2) as $chunk)
	    <div class="row">
	    	<p>master{{ $loop->iteration }}</p>
	        @foreach ($chunk as $product)
	            <div class="col-xs-4">{{ $product->name }}</div>
	            <p>.{{ $loop->iteration }}</p>
	        @endforeach
	    </div>
	@endforeach

<p>This is the first paragraph in the body of your new HTML file!</p>

</body>
</html>