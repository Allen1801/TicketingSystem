@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{__('Notification')}}</div>
                <div class="card-body ">
                    <p>1. How satisfied are you with your experience using our ticketing system?</p>
                    <input type="radio" name="no1" id="no1op1">
                    <label for="no1op1">Very satisfied</label><br>
                    <input type="radio" name="no1" id="no1op2">
                    <label for="no1op2">Satisfied</label><br>
                    <input type="radio" name="no1" id="no1op3">
                    <label for="no1op3">Neutral</label><br>
                    <input type="radio" name="no1" id="no1op4">
                    <label for="no1op4">Dissatisfied</label><br>
                    <input type="radio" name="no1" id="no1op5">
                    <label for="no1op5">Very dissatisfied</label>
                    <br><br>
                    <p>2. How easy was it to submit a ticket?</p>
                    <input type="radio" name="no2" id="no2op1">
                    <label for="no2op1">Very easy</label><br>
                    <input type="radio" name="no2" id="no2op2">
                    <label for="no2op2">Easy</label><br>
                    <input type="radio" name="no2" id="no2op3">
                    <label for="no2op3">Neutral</label><br>
                    <input type="radio" name="no2" id="no2op4">
                    <label for="no2op4">Difficult</label><br>
                    <input type="radio" name="no2" id="no2op5">
                    <label for="no2op5">Very difficult</label>
                    <br><br>
                    <p>3. How satisfied are you with the response time to your ticket?</p>
                    <input type="radio" name="no3" id="no3op1">
                    <label for="no3op1">Very satisfied</label><br>
                    <input type="radio" name="no3" id="no3op2">
                    <label for="no3op2">Satisfied</label><br>
                    <input type="radio" name="no3" id="no3op3">
                    <label for="no3op3">Neutral</label><br>
                    <input type="radio" name="no3" id="no3op4">
                    <label for="no3op4">Dissatisfied</label><br>
                    <input type="radio" name="no3" id="no3op5">
                    <label for="no3op5">Very dissatisfied</label>
                    <br><br>
                    <p>4. How clear was the communication regarding the progress of your ticket?</p>
                    <input type="radio" name="no4" id="no4op1">
                    <label for="no4op1">Very clear</label><br>
                    <input type="radio" name="no4" id="no4op2">
                    <label for="no4op2">Clear</label><br>
                    <input type="radio" name="no4" id="no4op3">
                    <label for="no4op3">Neutral</label><br>
                    <input type="radio" name="no4" id="no4op4">
                    <label for="no4op4">Unclear</label><br>
                    <input type="radio" name="no4" id="no4op5">
                    <label for="no4op5">Very unclear</label>
                    <br><br>
                    <p>5. How helpful were the support staff in resolving your issue?</p>
                    <input type="radio" name="no5" id="no5op1">
                    <label for="no5op1">Very helpful</label><br>
                    <input type="radio" name="no5" id="no5op2">
                    <label for="no5op2">Helpful</label><br>
                    <input type="radio" name="no5" id="no5op3">
                    <label for="no5op3">Neutral</label><br>
                    <input type="radio" name="no5" id="no5op4">
                    <label for="no5op4">Unhelpful</label><br>
                    <input type="radio" name="no5" id="no5op5">
                    <label for="no5op5">Very unhelpful</label>
                    <br><br>
                    <p>6. Were your issues resolved to your satisfaction?</p>
                    <input type="radio" name="no6" id="no6op1">
                    <label for="no6op1">Yes, completely</label><br>
                    <input type="radio" name="no6" id="no6op2">
                    <label for="no6op2">Yes, somewhat</label><br>
                    <input type="radio" name="no6" id="no6op3">
                    <label for="no6op3">No, not at all</label>
                    <br><br>
                    <p>7. Did you experience any technical issues or system errors while using the ticketing system?</p>
                    <input type="radio" name="no7" id="no7op1">
                    <label for="no7op1">Yes</label><br>
                    <input type="radio" name="no7" id="no7op2">
                    <label for="no7op2">No</label>
                    <br><br>
                    <p>8. How likely are you to recommend our ticketing system to others?</p>
                    <input type="radio" name="no8" id="no8op1">
                    <label for="no8op1">Very likely</label><br>
                    <input type="radio" name="no8" id="no8op2">
                    <label for="no8op2">Likely</label><br>
                    <input type="radio" name="no8" id="no8op3">
                    <label for="no8op3">Neutral</label><br>
                    <input type="radio" name="no8" id="no8op4">
                    <label for="no8op4">Unlikely</label><br>
                    <input type="radio" name="no8" id="no8op5">
                    <label for="no8op5">Very unlikely</label>
                    <br><br>
                    <p>9. Do you have any suggestions for improving our ticketing system or support process?</p>
                    <textarea name="no9" id="no9op1" cols="50" rows="5"></textarea>
                    <br><br>
                    <p>10. Is there anything else you would like to share about your experience with our ticketing system?</p>
                    <textarea name="no0" id="no0op1" cols="50" rows="5"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection