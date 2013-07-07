

<div class="row-fluid">
    <div class="span10">
        <?php
        if (empty($favorites)) {
        ?>
            <div class="alert alert-danger">
                暂无收藏记录！
            </div>
        <?php
        } else {
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>收藏记录</th>
                        <th>日期</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($favorites as $favorite) {
                    ?>
                        <tr>
                            <td><?php echo $favorite['id']; ?></td>
                            <td><a href="/search?k=<?php echo $favorite['text']; ?>" target="_blank"><?php echo $favorite['text']; ?></a></td>
                            <td><?php echo date('Y-m-d H:i', $favorite['dateline']); ?></td>
                            <td><a href="/searchFavorite/remove?id=<?php echo $favorite['id']; ?>">删除</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>
    <div class="span2">
        <p><a href="/user/changePassword">修改密码</a></p>
        <p><a href="/searchFavorite/list">收藏列表</a></p>
    </div>
</div>