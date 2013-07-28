/**
 * Created with JetBrains PhpStorm.
 * User: Алексей
 * Date: 07.04.13
 * Time: 19:48
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){
    $(".needs_confirmation").click(function(e) {
        e.preventDefault();
        var targetUrl = $(this).attr("href");

        if (confirm('Удалить?')) {
            window.location.href = targetUrl;
        }
    });
});