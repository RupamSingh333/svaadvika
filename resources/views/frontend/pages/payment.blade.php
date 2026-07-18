@extends('frontend.layouts.master')

@section('content')
<div class="container py-5 text-center" style="min-height: 60vh;">
    <h2 class="mb-4">Processing Payment...</h2>
    <p>Please wait while we redirect you to the payment gateway. Do not refresh this page.</p>

    <!-- Hidden form for Razorpay callback -->
    <form action="{{ route('checkout.razorpay_callback') }}" method="POST" id="razorpay-form">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="{{ $order->razorpay_order_id }}">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>
</div>
@endsection

@push('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ env('RAZORPAY_KEY') }}",
        "amount": "{{ round($order->total_amount * 100) }}", 
        "currency": "INR",
        "name": "Svaadvika",
        "description": "Payment for Order {{ $order->order_number }}",
        "order_id": "{{ $order->razorpay_order_id }}",
        "handler": function (response){
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.getElementById('razorpay-form').submit();
        },
        "prefill": {
            "name": "{{ $customer->name ?? '' }}",
            "email": "{{ $customer->email ?? '' }}",
            "contact": "{{ $customer->phone ?? '' }}"
        },
        "theme": {
            "color": "#198754"
        },
        "modal": {
            "ondismiss": function(){
                window.location.href = "{{ route('home') }}";
            }
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
        alert(response.error.description);
        window.location.href = "{{ route('home') }}";
    });
    
    // Automatically open the Razorpay modal
    document.addEventListener('DOMContentLoaded', function() {
        rzp1.open();
    });
</script>
@endpush
