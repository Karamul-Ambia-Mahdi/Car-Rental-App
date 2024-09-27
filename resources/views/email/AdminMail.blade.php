<div style="font-family: Helvetica, Arial, sans-serif; min-width: 1000px; overflow: auto; line-height: 2;">
    <div style="margin: 50px auto; width: 70%; padding: 20px 0">
        <div style="border-bottom: 1px solid #eee">
            <a href="" style="font-size: 1.4em; color: #6d3b47; text-decoration: none; font-weight: 600;">
                New Car Rental - {{ $carName }} by {{ $customerName }}</a>
        </div>
        <p style="font-size: 1.1em; color: #a55c5f; font-weight: bolder;">Dear Admin,</p>
        <p>A new car rental has been booked by {{ $customerName }} for the following details:</p>
        <ul style="font-size: 1.1em; color: #a55c5f; font-weight: bolder;">
            <li><strong style="font-size: 1.1em; color: #c58486;">Car Name:</strong> {{ $carName }}</li>
            <li><strong style="font-size: 1.1em; color: #c58486;">Rental Period:</strong> {{ $rentalStartDate }} to {{ $rentalEndDate }}</li>
            <li><strong style="font-size: 1.1em; color: #c58486;">Customer Name:</strong> {{ $customerName }}</li>
            <li><strong style="font-size: 1.1em; color: #c58486;">Customer Email:</strong> {{ $customerEmail }}</li>
            <li><strong style="font-size: 1.1em; color: #c58486;">Customer Phone Number:</strong>{{ $customerPhone }}</li>
        </ul>
        <p>
            Please review the rental details and ensure that the car is available for pickup at {{ $customerAddress }} on
            {{ $rentalStartDate }}.</p>
        <p>If you have any questions or concerns, please contact the customer at {{ $customerEmail }} or
            {{ $customerPhone }}.</p>
  
            <p style="font-size: 0.9em;font-weight: bolder;color:#6d3b47;">Best Regards,<br /><i style="color: #a55c5f;">Quick Car Rental</i></p>
  
        <hr style="border: none; border-top: 1px solid #eee" />
  
        <div style="float: right; padding: 8px 0; color: #a55c5f; font-size: 0.8em; line-height: 1; font-weight: 300">
            <p>Quick Car Rental</p>
            <p>Shop No-21, Shapla Super Market, Station Road</p>
            <p>Sreemangal-3210</p>
        </div>
    </div>
  </div>
  