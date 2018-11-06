<?php session_start(); ?>
<html>  
	<head>
	    <title> Central Instrumentation Facility - NIPER Ahmedabad </title>
	</head>
	<style>
	    .loader-bg {
	        width: 100%;
	        height: 100vh;
	        z-index: 99;
	        position: fixed;
	        top:0;
	        left: 0;
	        background-color: rgba(0,0,0,0.8);
	    }

	    .loader {
	        position: absolute;
	        top: 46%;
	        left: 50%;
	        transform: translate(-50%, -50%);
	        margin: 0;
	        padding: 0;
	        display: flex;
	    }

	    .loader li {
	    	font-family: 'Open Sans', sans-serif;
	        color: #ffffff !important;
	        font-size: 1em;
	        padding: 5px;
	        text-align: center;
	        width: 20px;
	        height: 20px;
	        background: #102D5E;
	        border-radius: 50%;
	        margin: 0.4rem;
	        animation: animate 1.4s linear infinite;
	        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
	    }

	    @keyframes animate {
	        0% {
	            transform: translateY(0);
	        }

	        20% {
	            transform: translateY(10px);
	        }

	        40% {
	            transform: translateY(20px);
	        }

	        60% {
	            transform: translateY(20px);
	        }

	        80% {
	            transform: translateY(10px);
	        }

	        100% {
	            transform: translateY(0)
	        }
	    }

	    .loader-bg ul {
	        list-style-type: none;
	        margin: 0;
	        padding: 0;
	    }

	    .loader li:nth-child(1) {
	        animation-delay: 0s;
	    }

	    .loader li:nth-child(2) {
	        animation-delay: -1.2s;
	    }

	    .loader li:nth-child(3) {
	        animation-delay: -1s;
	    }

	    .loader li:nth-child(4) {
	        animation-delay: -.8s;
	    }

	    .loader li:nth-child(5) {
	        animation-delay: -6s;
	    }
	</style>

	<body>
	    <div class="loader-bg" style="display: block;">
	        <ul class="loader">
	            <li>N</li><li>I</li><li>P</li><li>E</li><li>R</li>
	        </ul>
	    </div>
	</body>

</html>