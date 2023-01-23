<form action="" method="get" id="filterOrderForm">
   <ul class="space-y-1">
      <li> 
         <label class="cont">Unprocessed Orders
         <input
            type="radio"
            name="status"
            value="unprocessed"
            id="filterOrder"
            {{ request()->status == 'unprocessed' ? 'checked' : '' }}
         >
         <span class="checkmark"></span>
         </label>
      </li>
      <li> 
         <label class="cont">Open Orders
         <input
            type="radio"
            name="status"
            value="request"
            id="filterOrder"
            {{ request()->status == 'request' ? 'checked' : '' }}
         >
         <span class="checkmark"></span>
         </label>
      </li>
      <li> 
         <label class="cont">Delivered Orders
         <input
            type="radio"
            name="status"
            value="delivered"
            id="filterOrder"
            {{ request()->status == 'delivered' ? 'checked' : '' }}
         >
         <span class="checkmark"></span>
         </label>
      </li>
      <li> 
         <label class="cont">Accepted Orders
         <input
            type="radio"
            name="status"
            value="approved"
            id="filterOrder"
            {{ request()->status == 'approved' ? 'checked' : '' }}
         >
         <span class="checkmark"></span>
         </label>
      </li>
      <li> 
         <label class="cont">Rejected Orders
         <input
            type="radio"
            name="status"
            value="rejected"
            id="filterOrder"
            {{ request()->status == 'rejected' ? 'checked' : '' }}
         >
         <span class="checkmark"></span>
         </label>
      </li>
   </ul>                        
</form>