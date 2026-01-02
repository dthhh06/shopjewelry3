<h1 class="mt-4">Phân quyền cho Role: <strong><?= htmlspecialchars($role['name']) ?></strong></h1>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-key me-1"></i>
        Phân quyền chi tiết
    </div>
    <div class="card-body">

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                Cập nhật phân quyền thành công!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="index.php?act=role-permissions&id=<?= $role['id'] ?>" method="POST">

            <?php 
            $currentGroup = '';
            foreach ($permissions as $perm): 
                // Khi chuyển sang group mới
                if ($currentGroup !== $perm['group_name']): 
                    // Đóng group cũ nếu có
                    if ($currentGroup !== ''): 
                        echo '</div></div>'; // đóng row và card-body group
                    endif;

                    $currentGroup = $perm['group_name'];
            ?>
                    <!-- Tiêu đề group mới -->
                    <div class="mb-4">
                        <h5 class="text-primary fw-bold mb-3 border-bottom pb-2">
                            <i class="fas fa-folder me-2"></i> <?= htmlspecialchars($currentGroup) ?>
                        </h5>
                        <div class="row">
            <?php endif; ?>

                        <!-- Mỗi quyền một ô -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="permission[<?= $perm['id'] ?>]" value="1"
                                       id="perm_<?= $perm['id'] ?>"
                                       <?= $perm['isAllowed'] ? 'checked' : '' ?>>
                                <label class="form-check-label fw-medium" for="perm_<?= $perm['id'] ?>">
                                    <?= htmlspecialchars($perm['description']) ?>
                                </label>
                            </div>
                        </div>

            <?php 
            endforeach; 
            // Đóng group cuối cùng
            if ($currentGroup !== ''): 
                echo '</div></div>'; 
            endif; 
            ?>

            <div class="mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-success btn-lg px-5">
                    <i class="fas fa-save me-2"></i> Lưu phân quyền
                </button>
                <a href="index.php?act=role" class="btn btn-secondary btn-lg px-5">
                    <i class="fas fa-arrow-left me-2"></i> Quay lại danh sách
                </a>
            </div>

        </form>
    </div>
</div>