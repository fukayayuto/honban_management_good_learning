<div class="container">
    <table class="table">
        <thead>
            <tr class="success">
                <th>ユーザーID</th>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>会社名</th>
                <th>営業所</th>
                <th>電話番号</th>
                <th>更新日時</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data as $k => $val) : ?>
                <tr>
                    <td><a href="/management/account/detail/?id=<?php echo $val['id']; ?>"><?php echo $val['id']; ?></a></td>
                    <td><?php echo $val['name']; ?></td>
                    <td><?php echo $val['email']; ?></td>
                    <td><?php echo $val['company_name']; ?></td>
                    <td><?php echo $val['sales_office']; ?></td>
                    <td><?php echo $val['phone']; ?></td>
                    <td><?php echo $val['updated_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>