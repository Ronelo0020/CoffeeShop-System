<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff | Riverside Café</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="card mx-auto shadow-sm" style="max-width: 500px; border-radius: 15px;">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4">Edit Staff Member</h4>
                <form action="<?= base_url('auth/update/'.$staff['id']) ?>" method="post">
                    <div class="mb-3">
                        <label class="small fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $staff['name'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $staff['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Role</label>
                        <select name="role" class="form-select">
                            <option value="admin" <?= $staff['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="staff" <?= $staff['role'] == 'staff' ? 'selected' : '' ?>>Staff</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('auth/manage') ?>" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-danger">Update Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>