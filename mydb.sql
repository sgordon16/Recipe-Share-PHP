-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2020 at 03:20 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `diet_options`
--

CREATE TABLE `diet_options` (
  `name` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diet_options`
--

INSERT INTO `diet_options` (`name`, `type`) VALUES
('Alcohol-free', 'health'),
('Balanced', 'diet'),
('Dairy-free', 'health'),
('Gluten-free', 'health'),
('High-fiber', 'diet'),
('High-protein', 'diet'),
('Low-carb', 'diet'),
('Low-fat', 'diet'),
('Peanut-free', 'health'),
('Sugar-conscious', 'health'),
('Tree-nut-free', 'health'),
('Vegan', 'health'),
('Vegetarian', 'health');

-- --------------------------------------------------------

--
-- Table structure for table `eating_options`
--

CREATE TABLE `eating_options` (
  `option_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eating_options`
--

INSERT INTO `eating_options` (`option_description`) VALUES
('Because I love food'),
('Because I\'m bored'),
('Because I\'m stressed out'),
('Because I\'m tired '),
('Because the food is in my face'),
('To satisfy my hunger'),
('To socialize');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `ID` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `ingredients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`ID`, `title`, `ingredients`, `directions`, `time`, `diet`, `imgUrl`, `servings`, `caloriesPerServing`, `totalRating`, `rates`, `date`, `username`) VALUES
(1, 'Chicken Vesuvio', '[ \"1/2 cup olive oil\", \"5 cloves garlic, peeled\", \"2 large russet potatoes, peeled and cut into chunks\", \"1 3-4 pound chicken, cut into 8 pieces (or 3 pound chicken legs)\", \"3/4 cup white wine\", \"3/4 cup chicken stock\", \"3 tablespoons chopped parsley\", \"1 tablespoon dried oregano\", \"Salt and pepper\", \"1 cup frozen peas, thawed\" ]', 'Preheat oven to 350. Mix everything together. Bake for time. It will be delicous.', 60, '[ \"Low-carb\" ]', 'https://www.edamam.com/web-img/e42/e42f9119813e890af34c259785ae1cfb.jpg', 4, 1013, 30, 7, '2020-02-06 00:56:58', ''),
(2, 'Pimento Cheese', '[ \"1 lb Cheddar cheese, grated\", \"1/4 lb Cream Cheese,softened\", \"3/4 tsp freshly ground white pepper\", \"2 x Red Bell Peppers(large),roasted), peeled, seeded and diced\", \"1/4 cup Mayonnaise or homemade (best-quality commercial )\", \"1 tsp Granulated Sugar\", \"5 Splashes Hot Sauce\", \"1/8 tsp Cayenne Pepper\", \"1 pinch salt\" ]', 'Preheat oven to 350. Mix everything together. Bake for time. It will be delicous.', 45, '[ \"Vegetarian\" ]', 'https://www.edamam.com/web-img/523/523a04dc691e7c0e7699523fd22a334a.jpg', 10, 272, 16, 5, '2020-02-06 00:56:58', ''),
(3, 'Baked Potato Snack', '[ \"1 medium sweet potato, or baking potato\", \"Salt and freshly ground black pepper\" ]', 'Bake 1 hour or until skin feels crisp but flesh beneath feels soft. Serve by creating a dotted line from end to end with your fork, then crack the spud open by squeezing the ends towards one another.', 30, '[ \"Low-Fat\", \"Vegan\" ]', 'https://www.edamam.com/web-img/c03/c03870c0284bdb80902ce95f24187714.jpg', 2, 83, 4, 1, '2020-02-08 21:38:52', ''),
(4, 'Caramel Cake', '[ \"2 cup sifted cake flour(not self-rising; sift before measuring),for cake\", \"2 tbsp sifted cake flour,for cake\", \"1 tsp Baking Powder,for cake\", \"3/4 tsp Baking Soda,for cake\", \"1/2 tsp Salt,for cake\", \"1 stick unsalted butter, softened(4 oz),for cake\", \"1 cup Granulated Sugar,for cake\", \"1 tsp pure vanilla extract,for cake\", \"2 x large eggs, at room temperature 30 minutes,for cake\", \"1 cup Buttermilk,well shaken,for cake\", \"1 cup Heavy Cream,for caramel glaze\", \"1/2 cup packed light brown sugar,for caramel glaze\", \"1 tbsp Light Corn Syrup,for caramel glaze\", \"1 tsp pure vanilla extract,for caramel glaze\" ]', 'Preheat oven to 350 degrees F (175 degrees C). Grease and flour a 9x9 inch pan or line a muffin pan with paper liners.\r\nIn a medium bowl, cream together the sugar and butter. Beat in the eggs, one at a time, then stir in the vanilla. Combine flour and baking powder, add to the creamed mixture and mix well. Finally stir in the milk until batter is smooth. Pour or spoon batter into the prepared pan.\r\nBake for 30 to 40 minutes in the preheated oven. For cupcakes, bake 20 to 25 minutes. Cake is done when it springs back to the touch.', 60, '[ \"Vegetarian\", \"Peanut-Free\" ]', 'https://www.edamam.com/web-img/482/482417e9943411f0e7db4be74a7b5114.jpg', 14, 210, 4, 1, '2020-02-08 21:42:53', ''),
(5, 'Chicken Soup', '[ \"2 1/2 cups of water\", \"1 chicken breast\", \"1/2 cup soup shape pasta (we use barilla orzo or pastina; or short-grain white rice, if you cannot find the soup pasta)\", \"1 teaspoon of sea salt\", \"1 1/2 tablespoon of extra virgin olive oil\", \"Cilantro for garnish\" ]', 'Place a large dutch oven or pot over medium high heat and add in oil. Once oil is hot, add in garlic, onion, carrots and celery; cook for a few minutes until onion becomes translucent. Reduce heat to medium low and simmer uncovered for 20-25 minutes or until chicken is fully cooked.\r\n', 45, '[ \"Sugar-Conscious\", \"Peanut-Free\" ]', 'https://www.edamam.com/web-img/bab/bab4ee2d4ce0e0bbb626f098069ee98e.JPG', 2, 412, 7, 2, '2020-02-08 21:48:52', ''),
(6, 'Mixed Greens Salad', '[ \"6 to 8 cups fresh salad greens: red or green leaf lettuce, romaine hearts, arugula, watercress, spinach, or frisée, or a mixture\", \"1/4 cup Classic Vinaigrette (see note), plus more for passing\" ]', 'Prepare the salad dressing: To make the salad dressing recipe, just whisk all of the ingredients together in a bowl (or shake them up in a mason jar) until combined.\r\nToss all of your salad ingredients together: Combine them in a large bowl, drizzle evenly with the dressing, then toss lightly until combined.', 15, '[ \"Low-Carb\", \"Vegan\" ]', 'https://www.edamam.com/web-img/893/893b3132c9db111710d5e823a1a84dd7.jpg', 6, 52, 10, 3, '2020-02-08 21:52:48', ''),
(7, 'Spice-Rubbed Grilled Meat', '[ \"1 tablespoon whole black peppercorns, toasted\", \"1 teaspoon coriander seed, toasted\", \"1 teaspoon fennel seed, toasted\", \"1 teaspoon cumin pods, toasted\", \"1 teaspoon red pepper flakes\", \"1/2 teaspoon dried oregano\", \"2 medium cloves garlic, minced (about 2 taspoons)\", \"2 tablespoons vegetable or canola oil\", \"1 whole flap meat steak, 2 to 2 1/2 pounds\", \"Kosher salt\" ]', 'Heat olive oil and garlic in a covered microwave safe bowl for 50 to 60 seconds. Remove and allow to cool. Add herbs and stir. Let cool for 5 minutes.\r\n\r\nPlace the meat into a shallow glass dish. Pour herb mixture over and turn steaks to coat. Cover and let marinate for 2 to 4 hours in the refrigerator.\r\n\r\nPreheat grill for high heat. Right before placing steaks on grill, oil grill grates with a long pair of tongs, folded paper towels, and oil. Make 3 to 4 passes on grates.\r\n\r\nRemove steaks, and season both sides with salt and pepper. Place onto grill and cook for 5 to 6 minutes per side, or cook to desired doneness.', 45, '[ \"Low-Carb\" ]', 'https://www.edamam.com/web-img/d97/d9786408ecad48bff714e1076ae07f1b.jpg', 4, 557, 6, 2, '2020-02-08 21:58:05', ''),
(8, 'Peach Basil Kefir Smoothie', '[ \"1/2 cup plus 2 tablespoons plain whole-milk kefir\", \"2 ripe medium peaches, pitted and quartered\", \"4 large basil leaves\", \"5 Kefir ice cubes\", \"Additional peaches, for garnish (optional)\" ]', 'Blend together and enjoy', 5, '[ \"Vegetarian\", \"Peanut-Free\" ]', 'https://www.edamam.com/web-img/6d9/6d993e74dd6a486e2f268d05cb6a937e.jpg', 1, 900, 11, 3, '2020-02-08 22:44:07', ''),
(15, 'Burger', '[\"1 cup water\"]', 'Mix together and enjoy', 10, '[\"Alcohol-free\",\"Gluten-free\"]', '', 2, 450, 3, 1, '2020-02-13 20:16:44', 'mike'),
(16, 'Recipe', '\"1 water\"', 'hjlhkrh', 2, '[\"Alcohol-free\",\"High-protein\"]', '', 2, 30, 0, 0, '2020-02-13 20:19:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` datetime NOT NULL,
  `gender` varchar(10) NOT NULL,
  `height` decimal(10,0) NOT NULL,
  `weight` int(11) NOT NULL,
  `reason_for_eating` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `dob`, `gender`, `height`, `weight`, `reason_for_eating`) VALUES
('Batsheva', 'sunflower1', 'shevy303@gmail.com', '1996-10-04 00:00:00', 'Female', '66', 127, 'To satisfy my hunger'),
('Bisi', 'bisi95', 'bisi@gmail.com', '1997-09-06 00:00:00', 'Female', '63', 140, 'To socialize'),
('mike', 'mike95', 'mike@gamil.com', '1997-09-06 00:00:00', 'male', '64', 146, 'To socialize'),
('Shlomo', 'keyboard95', 'shlomozgordon@gmail.com', '1995-09-06 00:00:00', 'Male', '69', 145, 'To satisfy my hunger');

-- --------------------------------------------------------

--
-- Table structure for table `users_saved_recipes`
--

CREATE TABLE `users_saved_recipes` (
  `username` varchar(30) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_saved_recipes`
--

INSERT INTO `users_saved_recipes` (`username`, `recipe_id`) VALUES
('Bisi', 6),
('mike', 7),
('Shlomo', 2),
('Shlomo', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_diets`
--

CREATE TABLE `user_diets` (
  `username` varchar(30) NOT NULL,
  `diet` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_diets`
--

INSERT INTO `user_diets` (`username`, `diet`) VALUES
('Batsheva', 'Alcohol-free'),
('Batsheva', 'Sugar-conscious'),
('Bisi', 'Alcohol-free'),
('mike', 'Alcohol-free'),
('Shlomo', 'Balanced'),
('Shlomo', 'Peanut-free'),
('Shlomo', 'Vegan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diet_options`
--
ALTER TABLE `diet_options`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `eating_options`
--
ALTER TABLE `eating_options`
  ADD PRIMARY KEY (`option_description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `eating` (`reason_for_eating`);

--
-- Indexes for table `users_saved_recipes`
--
ALTER TABLE `users_saved_recipes`
  ADD PRIMARY KEY (`username`,`recipe_id`),
  ADD KEY `recipe` (`recipe_id`);

--
-- Indexes for table `user_diets`
--
ALTER TABLE `user_diets`
  ADD PRIMARY KEY (`username`,`diet`),
  ADD KEY `diet` (`diet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `eating` FOREIGN KEY (`reason_for_eating`) REFERENCES `eating_options` (`option_description`);

--
-- Constraints for table `users_saved_recipes`
--
ALTER TABLE `users_saved_recipes`
  ADD CONSTRAINT `recipe` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`ID`),
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `user_diets`
--
ALTER TABLE `user_diets`
  ADD CONSTRAINT `diet` FOREIGN KEY (`diet`) REFERENCES `diet_options` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
