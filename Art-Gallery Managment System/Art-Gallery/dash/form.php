<form method="post" action="create.php" enctype="multipart/form-data">
  <label for="title">Title:</label>
  <input type="text" name="title" required>

  <label for="artist_id">Artist ID:</label>
  <input type="number" name="artist_id" required>

  <label for="year_created">Year created:</label>
  <input type="number" name="year_created" required>

  <label for="medium">Medium:</label>
  <input type="text" name="medium" required>

  <label for="dimensions">Dimensions:</label>
  <input type="text" name="dimensions" required>

  <label for="price">Price:</label>
  <input type="number" name="price" required>

  <label for="availability">Availability:</label>
  <select name="availability" required>
    <option value="available">Available</option>
    <option value="not_available">Not available</option>
  </select>

  <label for="image">Image:</label>
  <input type="file" name="image" required>

  <label for="description">Description:</label>
  <textarea name="description" required></textarea>

  <button type="submit">Submit</button>
</form>
