use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <style>
        .income { color: green; }
        .expense { color: red; }
    </style>
</head>
<body>
    <h1>My Wallet!</h1>
    <div>
        <h3>Balance: ${{number_format($balance)}} </h3>
        <p class="income"> Total Income: + {{number_format($totalIncome)}} </p>
        <p class="expense">Total Expenses: -${{ number_format($totalExpense) }}</p>
    </div>

    <hr>

    <form action="/add-transaction" method="POST">
        @csrf 
        <input type="text" name="name" placeholder="Description">
        <input type="number" name="amount" placeholder="Amount">
        <select name="type">
            <option value="expense">Expense (-)</option>
            <option value="income">Income (+)</option>
        </select>

        <button>Add Transaction</button>
    </form>

    <hr>

    <h3>History</h3>
    <ul>
        @foreach($transactions as $txn)
        <li>
            <span class="{{$txn->type}}">
                {{$txn->type}} : {{number_format($txn->amount)}}
            </span>
            <small> {{$txn->created_at->diffForHumans()}} </small>
        </li>
        @endforeach
    </ul>
</body>
</html>


