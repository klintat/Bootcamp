@extends('main')
@section("content")
<div class="custom-product">
    <div class="col-sm-10">
        <table class="table">
            <tbody>
                <tr>
                    <td>Amount</td>
                    <td>$ {{$total}}</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$ 0</td>
                </tr>
                <tr>
                    <td>Delivery</td>
                    <td>$ 10</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>$ {{$total+10}}</td>
                </tr>
            </tbody>
        </table>
        <div>
            <form action="/orderplace" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="address" class="form-control" placeholder="enter your address" aria-describedby="emailHelp"></textarea>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="form-group">
                    <label for="pwd">Payment Method</label><br></br>
                    <input type="radio" value="cash" name="payment"> <span>Online payment</span><br></br>
                    <input type="radio" value="cash" name="payment"> <span>EMI payment</span><br></br>
                    <input type="radio" value="cash" name="payment"> <span>Payment on delivery</span><br></br>
                </div>
                <button type="submit" class="btn btn-primary">Order Now</button>
            </form>
        </div>
    </div>   
</div>
@endsection 