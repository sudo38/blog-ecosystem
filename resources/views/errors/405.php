<?php view('front.layouts.header', ['title' => 'Method Not Allowed']) ?>

<h1 class="text-center mt-5">405 Method Not Allowed</h1>
<p>The method used is not allowed for this resource.</p>
<a href="{{ url('/') }}">Go to Home</a>