
<div class="row form-row-wrapper">
    <h3 class="form-title text-center">DAFTARKAN</h3>
    <form id="telesalesLigajudiReg" class="col s12" method="post" action="telesales/register/ligajudi">
        <div class="row">
            <div class="input-field col s12">
                <input id="full_name" type="text" class="validate fullname-control" name="full_name">
                <label for="full_name">Nama Lengkap <span>*</span></label>
                <span class="helper-text" data-error="required field *" data-success=""></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="date_field" type="date" class="validate dateofbirth-control" name="date_field">
                <label for="date_field">Tanggal Lahir</label>
                <span class="helper-text" data-error="required field *" data-success=""></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="email_field" type="email" class="validate email-control" name="email_field">
                <label for="email_field">Email</label>
                <span class="helper-text" data-error="required field *" data-success=""></span>
            </div>
        </div>
        <div class="row row-phone-field">
            <div class="cc-picker cc-picker-code-select-enabled">
                <div class="cc-picker-flag id"></div>
                <span class="cc-picker-code">+62</span>
            </div>
            <input type="number" id="phone_field" name="phone_field" class="phone-field validate phone-control">
            <input type="hidden" id="phone_field_phoneCode" name="phone_field_phoneCode" value="62">
        </div>
        <input type="hidden" name="current_url" value="<?=current_url()?>">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
        <div class="row row-submit">
            <button class="btn waves-effect waves-light" type="submit" name="form_submit">Submit
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>


<div id="popup_content_wrap" style='display:none'>
    <div id="popup_content">
        <center>
            <h3>REGISTRASI BERHASIL!</h3> 
            <br>
            <p>Tekan Tombol Lanjutkan, <br /> Layanan Customer Service 24 jam kami Siap melayani Anda </p>
            <a id="confirmReg" href="https://secure.livechatinc.com/licence/1997941/v2/open_chat.cgi" class="confirm-reg">LANJUTKAN</a>
        </center>
    </div>
</div>


<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
window.__lc = window.__lc || {};
window.__lc.license = 1997941;
(function() {
var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<noscript>
<a href="https://www.livechatinc.com/chat-with/1997941/" rel="nofollow">Chat with us</a>,
powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>
</noscript>
<!-- End of LiveChat code -->