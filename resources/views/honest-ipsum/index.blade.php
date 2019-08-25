@extends('layouts.app')

@section('content')


<div class="h-64 bg-fixed bg-cover bg-center" style="background-image: url('/img/forest_landscape.JPG')">
	{{-- <div class="logo">
		JCL logo
	</div> --}}
	<div class="text-center">
		<h1 class="pt-12 text-5xl font-serif">Honest Ipsum</h1>
		<p class="text-lg">Placeholder text that needs no explanation.</p>
	</div>
</div>


<div class="container mx-auto">

	<div class="mb-6 mx-auto bg-white w-3/4 shadow-lg rounded-lg p-4 text-lg text-center -mt-12">
		<div class="mb-4 leading-loose">

			I am a 
				<select id="career_select" class="font-semibold text-center border-b-4 border-teal-600 px-1 appearance-none hover:border-teal-500">
					<option>graphic designer</option>
					<option>web developer</option>
					<option>web designer</option>
					<option>app developer</option>
				</select> 
			who wants to generate 

			<input id="element_count_input" maxlength="3" class="font-semibold border-b-4 border-teal-600 px-1 w-10 appearance-none text-center hover:border-teal-500" value="2">

			<select id="element_select" class="font-semibold text-center border-b-4 border-teal-600 appearance-none hover:border-teal-500 px-1">
				<option value="p">paragraphs</option>
				<option value="li">list items</option>
			</select>
			of easy to understand placeholder text.
		</div>
		<div class="flex justify-center">
			<button onclick="generateIpsum()" id="generate_button" class="bg-teal-600 text-white text-base font-semibold rounded px-4 py-2  uppercase shadow hover:bg-teal-500">
			Generate Text
			</button>
		</div>
	</div>

	<div class="flex flex-wrap md:flex-no-wrap">

		<div class="w-full md:w-1/2 mb-6 mr-0 md:mb-0 md:mr-2">
			<div class="flex items-center mb-2 mx-4 sm:mx-0">
				<h2 class="uppercase text-lg text-gray-600 mr-2">TEXT</h2>
				<button id="copy_text_button" onclick="copyText()" class="text-teal-600 flex items-center font-semibold uppercase text-sm hover:text-teal-500">
						<svg class="h-4 w-4 fill-current" viewBox="0 0 384 512">
							<path d="M336 64h-80c0-35.29-28.71-64-64-64s-64 28.71-64 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 400H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h42v36c0 6.627 5.373 12 12 12h168c6.627 0 12-5.373 12-12v-36h42a6 6 0 0 1 6 6v340a6 6 0 0 1-6 6zM192 40c13.255 0 24 10.745 24 24s-10.745 24-24 24-24-10.745-24-24 10.745-24 24-24"/>
						</svg>
				</button>
			</div>
			<div id="text_area" class="p-4 shadow md:rounded-lg bg-white w-full">
				{!! $ipsum !!}
			</div>
			<input type="hidden" id="text_area_input" value="{{ strip_tags($ipsum) }}">
		</div>

		<div class="w-full md:w-1/2 mb-6 mr-0 md:mb-0 md:ml-2">
			<div class="flex items-center mb-2 mx-4 sm:mx-0">
				<h2 class="uppercase text-lg text-gray-600 mr-2">HTML</h2>
				<button id="copy_code_button" onclick="copyCode()" class="text-teal-600 flex items-center font-semibold uppercase text-sm hover:text-teal-500">
						<svg class="h-4 w-4 fill-current" viewBox="0 0 384 512">
							<path d="M336 64h-80c0-35.29-28.71-64-64-64s-64 28.71-64 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 400H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h42v36c0 6.627 5.373 12 12 12h168c6.627 0 12-5.373 12-12v-36h42a6 6 0 0 1 6 6v340a6 6 0 0 1-6 6zM192 40c13.255 0 24 10.745 24 24s-10.745 24-24 24-24-10.745-24-24 10.745-24 24-24"/>
						</svg>
				</button>
			</div>

			<div id="code_area" class="text-sm font-mono p-4 shadow md:rounded-lg bg-gray-800 text-teal-200 w-full">
				{{ $ipsum }}
			</div>
			<input type="hidden" id="code_area_input" value="{{$ipsum}}">
		</div>
	</div>

	{{-- <div class="bottom-0 sticky"> --}}
		<div class="flex justify-between">
			<div>
				Created By <a class="text-teal-600 hover:text-teal-500" href="johnclendvoy.ca">John C. Lendvoy</a>
			</div>
			<div>
				<a class="text-teal-600 hover:text-teal-500" href="https://github.com/johnclendvoy">Github</a>
				<a class="text-teal-600 hovver:text-teal-500" href="https://twitter.com/johnclendvoy">Twitter</a>
			</div>
		</div>
	{{-- </div> --}}
</div>

<script>

	function postAjax(url, data, success) {
	    var params = typeof data == 'string' ? data : Object.keys(data).map(
	            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
	        ).join('&');

	    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	    xhr.open('POST', url);
	    xhr.onreadystatechange = function() {
	        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
	    };
	    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    xhr.send(params);
	    return xhr;
	}

	let text_area = document.getElementById('text_area');
	let code_area = document.getElementById('code_area');
	let text_area_input = document.getElementById('text_area_input');
	let code_area_input = document.getElementById('code_area_input');

	function copyText () {

		text_area_input.select();
		// text_area.setSelectionRange(0, 99999); /*For mobile devices*/
		document.execCommand("copy");
		console.log('copied text');
	}

	function copyCode () {
		code_area_input.select();
		// code_area.setSelectionRange(0, 99999); /*For mobile devices*/
		document.execCommand("copy");
		console.log('copied code');
	}

	function generateIpsum () {
		let career = document.getElementById('career_select').value;
		let element = document.getElementById('element_select').value;
		let element_count = document.getElementById('element_count_input').value;

		let values = {
			_token: '{{csrf_token()}}',
			career: career,
			element: element,
			element_count: element_count,
		}

		postAjax('/', values, function(data){
			object = JSON.parse(data);
			text_area.innerHTML = object.result;
			code_area.textContent = object.result;
			text_area.value = text_area.innerHTML;
			code_area.value = code_area.innerHTML;
		});
	}
</script>

{{-- </div> --}}

{{--
<div class="bg-yellow-400">
	<h1 class="text-4xl">HONEST IPSUM</h1>
	<div id="buzz1" class="buzzword script">"The site looks great, I just don't know why some of the words are in Spanish!"</div>
	<div id="buzz2" class="buzzword script">"Looks great to me...apart from your Latin which is lousy!"</div>
	<div id="buzz3" class="buzzword script">"Hey looks nice, but the text content is obviously wrong...please fix it."</div>
</div>

	<h2 class="text-2xl">Meet Honest Ipsum</h2>
	<p>If the last thing you want to do is explain the history of why Latin text is being used as a placeholder in your design, this is the tool for you! Feel free to copy and paste this text and use it as a placeholder on your next project!</p>

	<h2>Online Generator</h2>
	<p>Just choose how many items to generate, their length in words, and what type of delimeter to use then hit generate.

	<form action="{{route('honest-ipsum.post')}}" method="post">
		{{csrf_field()}}

		@if(count($errors->all()))
		<p class="text-red-500">{{$errors->first()}}</p>
		@endif

		<label for="count-input" class="input-group-addon">Paragraphs</label>
		<input id="count-input" type="number" name="count" min="1" max="1000" class="text-right form-control square" placeholder="Paragraphs" value="{{old('count', $count)}}">

		<label for="length-input" class="input-group-addon">Words per Paragraph *</label>
		<input id="length-input" type="number" name="length" min="1" max="1000" class="text-right form-control square" placeholder="Paragraph Length" value="{{old('length', $length)}}">

		<div>
			<span data-format="nl" class="format-select btn btn-default btn-lg {{old('format',$format) === 'nl' ? 'active' : ''}}">\n</span>
			<span data-format="br" class="format-select btn btn-default btn-lg {{old('format',$format) === 'br' ? 'active' : ''}}">&lt;br&gt;</span>
			<span data-format="p"  class="format-select btn btn-default btn-lg {{old('format',$format) === 'p' ? 'active' : ''}}">&lt;p&gt;</span>
		</div>

		<input id="format-input" type="hidden" name="format" value="{{$format}}">

		<button type="submit" class="btn btn-success btn-lg pull-right">Generate</button>
	</form>

	<p>* The number of words in the paragraph should be within about 10 words of what you request.</p>

	<h2 class="text-2xl">API Documentation</h2>
	<p>You can also use the API to retrieve text, a GET request to:</p>
	<pre>http://honest-ipsum.johnclendvoy.ca/api?count=1&length=100&format=p</pre>

	<p>There are 3 simple parameters:</p>

	<dl class="dl-horizontal">
		<dt><code>count</code></dt> 
		<dd>How many elements to generate. Must be an integer between 1 and 500. Default: 2</dd>
		<dt><code>length</code></dt> 
		<dd>How many words are in each element. Must be an integer between 1 and 1000. Note that the exact number of words in each element may be slightly less than the entered value, it gets as close as possible without writing any sentence fragments. Default: 50</dd>
		<dt><code>format</code></dt>
		<dd>How should the elements be output? Accepted values are <code>p</code> (surrounded by &lt;p&gt; tags), <code>br</code> (followed by a &lt;br&gt; tag), <code>nl</code> ( followed by a newline character). Default: p</dd>
	</dl>
	<p>Support for more element formats is in progress.</p>
				
	<h2>Example Output</h2>

	{!!$ipsum!!}
	<pre id="copyable">{{$ipsum}}</pre>

	<h2>Credits</h2>
	<p>Thank you to the following reddit users at <a href="http://reddit.com/r/web_design">/r/web_design</a> for contributing content and or suggestions to improve this generator!</p>
	<p>
		@foreach($credits as $credit)
		<a href="http://reddit.com/u/{{$credit}}">/u/{{$credit}}</a>@unless($loop->last ),@endunless
		@endforeach
	</p>
	--}}

@endsection
