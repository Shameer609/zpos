<style>
@media print{
 
  .btn-delete{
    display: none !important;
  }
  
}

</style>
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang( 'restaurant.booking_details' )</h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<strong>@lang('contact.customer'):</strong> {{ $booking->customer->name }}<br>
						<strong>@lang('restaurant.service_staff'):</strong> {{ $booking->waiter->user_full_name ?? '--' }}<br>
						<strong>@lang('restaurant.correspondent'):</strong> {{ $booking->correspondent->user_full_name ?? '--' }}<br>
						@if(!empty($booking->booking_note))
						<strong>@lang('restaurant.customer_note'):</strong> {{ $booking->booking_note }}
						@endif
					</div>
					<div class="col-sm-6">
						<strong>@lang('messages.location'):</strong> {{ $booking->location->name }}<br>
						<strong>@lang('restaurant.table'):</strong> {{ $booking->table->name ?? '--' }}<br>
						<strong>@lang('restaurant.booking_starts'):</strong> {{ $booking_start }}<br>
						<strong>@lang('restaurant.booking_ends'):</strong> {{ $booking_end }}
					</div>
				</div>
				<br>
				<hr>
				<div class="row no-print">
					<div class="col-sm-12">
						<button type="button" class="btn btn-info btn-modal pull-right" data-href="{{action('NotificationController@getTemplate', ['transaction_id' => $booking->id,'template_for' => 'new_booking'])}}" data-container=".view_modal">@lang('restaurant.send_notification_to_customer')</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-9 no-print">
						{!! Form::open(['url' => action('Restaurant\BookingController@update', [$booking->id]), 'method' => 'PUT', 'id' => 'edit_booking_form' ]) !!}
							<div class="input-group">
				                <!-- /btn-group -->
				                {!! Form::select('booking_status', $booking_statuses, $booking->booking_status, ['class' => 'form-control', 'placeholder' => __('restaurant.change_booking_status'), 'required']); !!}
				                <div class="input-group-btn">
				                  <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
				                </div>
				             </div>
						{!! Form::close() !!}
					</div>
					<div class="col-sm-3 text-center">
						<button type="button" class="btn btn-danger no-print" id="delete_booking" data-href="{{action('Restaurant\BookingController@destroy', [$booking->id])}}">@lang('restaurant.delete_booking')</button>
					</div>
				</div>
				
				<table class="table">
				    <tr>
				        <th>Particular</th>
				         <th>Amount</th>
				         <th>Instructions</th>
				        
				        
				    </tr>
				    @foreach($booking_item as $booking_item)
				    <tr>
				        
				        <td>{{$booking_item->name}}</td>
				        <td>{{$booking_item->Item_amount}}</td>
				        <td>{{$booking_item->instructions}}</td>
				    </tr>
				    @endforeach
				    <tr>
				       <td>Discount</td>
				       <td>{{$booking_total->Discount}}</td>
				       <td></td>
				   </tr>
				   <tr>
				       <td>Total</td>
				       <td>{{$booking_total->total}}</td>
				       <td></td>
				   </tr>
				    
				    
				</table>
				
				<h3>Payment Details</h3>
				
				<table class="table">
				    <thead >
				        <tr>
				            <th>Date</th>
				            <th>Cash</th>
				            <th>Total Amount</th>
				            <th>Advance Amount</th>
				        </tr>
				    </thead>
				    <tbody>
				        @foreach($booking_payment as $booking_payment)
				        <tr>
				            <td>{{$booking_payment->created_at}}</td>
				            <td>Yes</td>
				            <td>{{$booking_payment->total_amount}}</td>
				            <td>{{$booking_payment->advance_amount}}</td>
				        </tr>
				        @endforeach
				    </tbody>
				</table>
				
				
				
			<br>
			<div class="modal-footer">
			<button type="button" class="btn btn-default no-print" data-dismiss="modal">@lang( 'messages.close' )</button>
			<button type="button" class="btn btn-primary no-print" aria-label="Print" 
            onclick="$(this).closest('div.modal-body').printThis();"><i class="fa fa-print"></i> @lang( 'messages.print' )
      </button>
			</div>
		

	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->