<div style="font-family: Helvetica, Arial, sans-serif; min-width: 1000px; overflow: auto; line-height: 2">
    <div style="margin: 50px auto; width: 70%; padding: 20px 0">
        <div style="border-bottom: 1px solid #eee">
            <a href="" style="font-size: 1.4em; color: #6d3b47; text-decoration: none; font-weight: 600">
                Car Rental Confirmation - {{ $carName }} from {{ $rentalStartDate }} to {{ $rentalEndDate }}</a>
        </div>
        <p style="font-size: 1.1em; color: #a55c5f; font-weight: bolder">Dear {{ $customerName }},</p>
        <p>
            We are pleased to confirm that your car rental request has been
            successfully processed. <br>Below are the details of your rental:
        </p>
        <ul style="font-size: 1.1em; color: #a55c5f; font-weight: bolder">
            <li><strong style="font-size: 1.1em; color: #c58486">Car Name:</strong> {{ $carName }}</li>
            <li><strong style="font-size: 1.1em; color: #c58486">Rental Period:</strong> {{ $rentalStartDate }} to {{ $rentalEndDate }}</li>
            <li><strong style="font-size: 1.1em; color: #c58486;">Pickup Location:</strong> {{ $customerAddress }}</li>
            <li><strong style="font-size: 1.1em; color: #c58486;">Total Cost: $</strong> {{ $totalCost }}</li>
        </ul> 
        <p>
            Please find the rental agreement attached to this email for your
            reference. If you have any questions or concerns, please do not hesitate
            to contact us at quick.car.rental@test.com or +880 1234 - 567890.
        </p>
        <p>
            Thank you for choosing our car rental service. We look forward to
            providing you with a smooth and enjoyable rental experience.
        </p>
        <p style="font-size: 0.9em;font-weight: bolder;color:#6d3b47;">Best Regards,<br /><i style="color: #a55c5f;">Karamul Ambia Mahdi</i></p>
  
        <hr style="border: none; border-top: 1px solid #eee" />
  
        <div style="float: right; padding: 8px 0; color: #a55c5f; font-size: 0.8em; line-height: 1; font-weight: 300">
            <p>Quick Car Rental</p>
            <p>Shop No-21, Shapla Super Market, Station Road</p>
            <p>Sreemangal-3210</p>
        </div>
    </div>
  </div>
  