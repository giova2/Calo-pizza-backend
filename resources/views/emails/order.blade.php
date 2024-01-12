@component('mail::message')
## <div style="text-align:center"> Thanks for your order!</div>

# Order information:

- Order Name: <strong>{{ $name }}</strong>
- Contact E-mail: <strong>{{ $email }}</strong>
- Contact phone: <strong>{{ $contact }}</strong>
- Last update: <strong>{{ $updated_at }}</strong>
- Delivery address: <strong>{{ $address }}</strong>

# Order details: 
---
- (this prices are expressed in Euros but the total is going to be expressed in the currency that you selected at the moment of your purchase)
---
<table class="order-details">
<thead>
    <tr style="border-bottom:2px solid black">
        <th>Name</th>
        <th>Ingredients</th>
        <th>Size</th>
        <th>Price</th>
        <th>Qty</th>
    </tr>
</thead>
<tbody>
@foreach($items as $item)
    <tr style="border:1px solid grey">
        <td>{{ $item['name'] }}</td>
        <td>{{ $item['ingredients'] }}</td>
        <td>{{ $item['size'] }}</td>
        <td>{{ $item['price'] }}</td>
        <td>{{ $item['quantity'] }}</td>
    </tr>
@endforeach
</tbody>
</table>

<br>
<br>

---

# TOTAL:    {{ $currency }} {{ $total }}

---

## The status of your order is <span class="status {{ $status }}"><strong>{{ $status }}</strong></span>

---

@component('mail::button', ['url' => config('app.front_url')])
Go to {{ config('app.name') }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
