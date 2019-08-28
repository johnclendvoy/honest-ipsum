@extends('layouts.app')

@section('content')


<div class="h-48 sm:h-64 bg-fixed bg-cover bg-center flex-shrink-0" style="background-image: url('/img/forest_landscape.JPG')">

	<div class="mx-auto mt-4 sm:ml-4 flex justify-center sm:justify-start">
			<svg viewBox="0 0 240 90" class="w-16 h-8 fill-current text-teal-600 hover:text-teal-500 cursor-pointer" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
				 <polygon points="50,0 90,0 100,17.32 60,86.6 0,86.6 10.00,69.28 0,51.96 20,51.96 30,69.28 60,17.32"/>
				 <polygon points="110,0 170,0 180,17.32 170,34.64 150,34.64 140, 51.96 150,69.28 140,86.6 80,86.6 120,17.32"/>
				 <polygon points="190,0 230,0 240,17.32 220,51.96 230,69.28 220,86.6 160,86.6 200,17.32"/>
			</svg>
	</div>

	<div class="text-center">
		<h1 class="mt-2 sm:mt-4 text-4xl sm:text-6xl font-serif text-white leading-tight tracking-tight">Honest Ipsum</h1>
		<p class="text-lg">Placeholder text that needs no explanation.</p>
	</div>
</div>


<div class="container mx-auto flex-1">

	<div class="mb-6 mx-auto bg-white w-3/4 shadow-lg rounded-lg p-4 text-lg text-center -mt-8 sm:-mt-12">
		<div class="mb-4 leading-loose">

			<span>I am a </span>

			<select id="career_select" class="font-semibold text-center border-b-4 border-teal-600 px-1 appearance-none hover:border-teal-500 rounded-none">
				<option>web developer</option>
				<option>graphic designer</option>
				<option>web designer</option>
				<option>app developer</option>
			</select> 

			<span>who wants to generate</span>

			<input id="element_count_input" maxlength="3" class="font-semibold border-b-4 border-teal-600 px-1 w-10 appearance-none text-center hover:border-teal-500 rounded-none" value="2">

			<select id="element_select" class="font-semibold text-center border-b-4 border-teal-600 appearance-none hover:border-teal-500 px-1 rounded-none">
				<option value="p">paragraphs</option>
				<option value="li">list items</option>
			</select>

			<span>of easy to understand placeholder text.</span>
		</div>

		<div class="flex justify-center">
			<button type="button" onclick="generateIpsum();" id="generate_button" class="bg-teal-600 text-white text-base font-semibold rounded px-4 py-2  uppercase shadow hover:bg-teal-500">
			Generate Text
			</button>
		</div>
	</div>

	<div class="flex flex-wrap md:flex-no-wrap">

		<div class="w-full md:w-1/2 mb-6 mr-0 md:mb-0 md:mr-2">
			<div class="flex items-center mb-2 mx-4 sm:mx-0">
				<h2 class="uppercase text-lg text-gray-700 mr-2">TEXT</h2>
				{{-- <button id="copy_text_button" onclick="copyText();" class="text-teal-600 flex items-center font-semibold uppercase text-sm hover:text-teal-500">
						<svg class="h-4 w-4 fill-current" viewBox="0 0 384 512">
							<path d="M336 64h-80c0-35.29-28.71-64-64-64s-64 28.71-64 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 400H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h42v36c0 6.627 5.373 12 12 12h168c6.627 0 12-5.373 12-12v-36h42a6 6 0 0 1 6 6v340a6 6 0 0 1-6 6zM192 40c13.255 0 24 10.745 24 24s-10.745 24-24 24-24-10.745-24-24 10.745-24 24-24"/>
						</svg>
				</button> --}}
			</div>
			<div id="text_area" class="p-4 shadow md:rounded-lg bg-white w-full">
				{!! $ipsum !!}
			</div>
			<input type="hidden" id="text_area_input" value="{{ strip_tags($ipsum) }}">
		</div>

		<div class="w-full md:w-1/2 mb-6 mr-0 md:mb-0 md:ml-2">
			<div class="flex items-center mb-2 mx-4 sm:mx-0">
				<h2 class="uppercase text-lg text-gray-700 mr-2">HTML</h2>
				{{-- <button id="copy_code_button" onclick="copyCode();" class="text-teal-600 flex items-center font-semibold uppercase text-sm hover:text-teal-500">
						<svg class="h-4 w-4 fill-current" viewBox="0 0 384 512">
							<path d="M336 64h-80c0-35.29-28.71-64-64-64s-64 28.71-64 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h288c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm-6 400H54a6 6 0 0 1-6-6V118a6 6 0 0 1 6-6h42v36c0 6.627 5.373 12 12 12h168c6.627 0 12-5.373 12-12v-36h42a6 6 0 0 1 6 6v340a6 6 0 0 1-6 6zM192 40c13.255 0 24 10.745 24 24s-10.745 24-24 24-24-10.745-24-24 10.745-24 24-24"/>
						</svg>
				</button> --}}
			</div>

			<div id="code_area" class="text-sm font-mono p-4 shadow md:rounded-lg bg-gray-800 text-teal-200 w-full">
				{{ $ipsum }}
			</div>
			<input type="hidden" id="code_area_input" value="{{$ipsum}}">
		</div>
	</div>
</div>

<footer class="flex justify-between items-center m-4 pb-10">
	<div class="text-gray-700">
		Created By <a class="text-teal-600 hover:text-teal-500" href="https://johnclendvoy.ca">John C. Lendvoy</a>
	</div>
	<div class="flex justify-end items-center">

		<a class="text-teal-600 hover:text-teal-500" href="https://github.com/johnclendvoy/honest-ipsum">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current text-teal-600 hover:text-teal-500" viewBox="0 0 24 24">
				<path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
			</svg>
		</a>

		<a class="text-teal-600 hovver:text-teal-500 ml-4" href="https://twitter.com/johnclendvoy">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current text-teal-600 hover:text-teal-500" viewBox="0 0 24 24">
				<path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
			</svg>
		</a>
	</div>
</footer>

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
