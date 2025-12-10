<form method="POST" action="edit.php?<?php echo http_build_query(['id' => $city->id]); ?>">
    <label for="city">City:</label>
    <input type="text" name="city" id="city" value="<?php echo e($city->city); ?>" required />

    <label for="cityAscii">City (ascii):</label>
    <input type="text" name="cityAscii" id="cityAscii" value="<?php echo e($city->cityAscii); ?>" required />

    <label for="country">Country:</label>
    <input type="text" name="country" id="country" value="<?php echo e($city->country); ?>" required />

    <label for="iso2">ISO-2:</label>
    <input type="text" name="iso2" id="iso2" value="<?php echo e($city->iso2); ?>" required />

    <label for="population">Population:</label>
    <input type="number" name="population" id="population" value="<?php echo e($city->population); ?>" required />

    <br />
    <input type="submit" value="Submit!" />
</form>