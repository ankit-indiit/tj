@if ( checkIfAuthIsSeller(Auth::user()->id) )
    <div class="become-a-seller"> 
		<div class="container-fluid alert">
		    <span class="closebtn" id="closeBecomeSeller" onclick="this.parentElement.style.display='none';">&times;</span>
		    <div class="flex items-center space-x-4 py-3 hover:bg-gray-100 rounded-md -mx-2 px-2">
	            <div class="flex-1">
	                <a href="{{ route('switch-as') }}" class="text-lg font-semibold capitalize"> lorem ipsum dolor sit amet consectetur  incididunt ut labore et dolore magna aliqua.</a>
	                <a href="{{ route('switch-as') }}" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold"> Switch to {{ Auth::user()->switch_as == 'buyer' ? 'Seller' : 'Buyer'}}</a>   
	            </div>
	        </div>
	    </div>
	</div>
@else
    <div class="become-a-seller "> 
		<div class="container-fluid alert">
		    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
		    <div class="flex items-center space-x-4 py-3 hover:bg-gray-100 rounded-md -mx-2 px-2">
	            <div class="flex-1">
	                <a href="{{ route('become.seller') }}" class="text-lg font-semibold capitalize"> lorem ipsum dolor sit amet consectetur  incididunt ut labore et dolore magna aliqua.</a>
	                <a href="{{ route('become.seller') }}" class="flex items-center justify-center h-9 px-4 rounded-md bg-gray-200 font-semibold"> Become a seller</a>   
	            </div>
	        </div>
	    </div>
	</div>
@endif