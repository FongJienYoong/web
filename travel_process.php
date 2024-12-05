<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Summary</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <table>
        <tr>
            <td colspan="2" class="header">Reservation Summary</td>
        </tr>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from the form
            $name = $_POST['name'];
            $ic_number = $_POST['ic_number'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $destination = $_POST['destination'];
            $cabin_class = $_POST['cabin_class'];
            $number_of_persons = $_POST['number_of_persons'];
            $departure_date = $_POST['departure_date'];
            $departure_time = $_POST['departure_time'];
            $services = isset($_POST['service']) ? implode(", ", $_POST['service']) : "None";
            $coupon_code = $_POST['coupon_code'];

            // Prices for destinations
            $destination_prices = [
                "Langkawi" => 200,
                "Kuala Lumpur" => 150,
                "Kuala Terengganu" => 180,
                "Kota Kinabalu" => 300,
                "Kuching" => 250,
            ];

            // Prices for cabin classes
            $cabin_class_prices = [
                "Economy Class" => 100,
                "Business Class" => 300,
            ];

            // Calculate total price
            $base_price = $destination_prices[$destination] ?? 0;
            $cabin_price = $cabin_class_prices[$cabin_class] ?? 0;
            $total_price = ($base_price + $cabin_price) * $number_of_persons;

            // Apply discount for valid coupon code
            if ($coupon_code == "ABC123") {
                $total_price *= 0.9; // 10% discount
                $discount_message = "ABC123 (10% Discount applied)";
            } else {
                $discount_message = "Invalid coupon code.";
            }
        ?>
        <tr>
            <td><strong>Full Name:</strong></td>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <td><strong>IC Number:</strong></td>
            <td><?php echo $ic_number; ?></td>
        </tr>
        <tr>
            <td><strong>Phone Number:</strong></td>
            <td><?php echo $phone_number; ?></td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <td><strong>Destination:</strong></td>
            <td><?php echo $destination . " (RM " . $destination_prices[$destination] . ")"; ?></td>
        </tr>
        <tr>
            <td><strong>Cabin Class:</strong></td>
            <td><?php echo $cabin_class . " (RM " . $cabin_class_prices[$cabin_class] . ")"; ?></td>
        </tr>
        <tr>
            <td><strong>Number of Persons:</strong></td>
            <td><?php echo $number_of_persons; ?></td>
        </tr>
        <tr>
            <td><strong>Departure Date:</strong></td>
            <td><?php echo $departure_date; ?></td>
        </tr>
        <tr>
            <td><strong>Departure Time:</strong></td>
            <td><?php echo $departure_time; ?></td>
        </tr>
        <tr>
            <td><strong>Services:</strong></td>
            <td><?php echo $services; ?></td>
        </tr>
        <tr>
            <td><strong>Coupon Code:</strong></td>
            <td><?php echo $discount_message; ?></td>
        </tr>
        <tr>
            <td><strong>Total Price:</strong></td>
            <td>RM <?php echo number_format($total_price, 2); ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
