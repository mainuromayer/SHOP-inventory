@extends('layout.dashboard')
@section('dashboard_content')
    <div class="container-fluid">
        <div class="row py-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Sales Report</h4>
                        <label class="form-label mt-2">Date From</label>
                        <input id="FormDate" type="date" class="form-control"/>
                        <label class="form-label mt-2">Date To</label>
                        <input id="ToDate" type="date" class="form-control"/>
                        <button onclick="SalesReport()" class="btn mt-3 text-white" style="background-image: linear-gradient(to top, rgb(0, 34, 141), rgb(37, 93, 157));">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>

    function SalesReport() {
        let FormDate = document.getElementById('FormDate').value;
        let ToDate = document.getElementById('ToDate').value;

        if(FormDate.length === 0 || ToDate.length === 0){
            errorToast("Date Range Required !")
        }else{
            window.open('/sales-report/'+FormDate+'/'+ToDate);
        }



    }

</script>
