<?php
$reviews = [
    ['user_id' => 9, 'product_id' => 1, 'rating' => 5, 'comment' => 'Exceptional quality. The yield was much higher than I anticipated. Highly recommend!'],
    ['user_id' => 10, 'product_id' => 1, 'rating' => 4, 'comment' => 'Good product overall, but delivery took a bit longer than expected.'],
    ['user_id' => 9, 'product_id' => 1, 'rating' => 5, 'comment' => 'Fantastic value for the price. Will definitely be purchasing again for the next season.'],
    ['user_id' => 10, 'product_id' => 1, 'rating' => 5, 'comment' => 'Very satisfied with the purchase! I planted these last week.'],
    ['user_id' => 9, 'product_id' => 1, 'rating' => 4, 'comment' => 'Works well as described. Germination rate is solid.']
];

foreach ($reviews as $r) {
    App\Models\Review::create($r);
}

echo "Reviews added successfully!\n";
