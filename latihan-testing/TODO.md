# TODO: Fix User Data Saving Issue

## Issues Identified and Fixed:
- [x] Model fillable array had 'nama' instead of 'name', causing mass assignment failure.
- [x] Form input name was 'nama' instead of 'name', not matching controller validation.
- [x] Ran the fix migration to ensure database column is 'name'.

## Changes Made:
- Updated app/Models/User.php: Changed fillable 'nama' to 'name'.
- Updated resources/views/user/create.blade.php: Changed input name from 'nama' to 'name'.
- Ran migration 2026_01_26_032401_fix_users_table_structure.php to confirm column structure.

## Testing:
- User creation should now save data correctly and display in the table.

# TODO: Add More Category Options to Product Add Page

## Task: Add many category options to the product creation page.

## Changes Made:
- Updated database/seeders/KategoriSeeder.php: Expanded the categories array from 8 to over 50 diverse categories.
- Ran the seeder to populate the database with new categories.

## Result:
- The product add page now has a dropdown with many category options for selection.
