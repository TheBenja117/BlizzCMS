<section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
  <div class="uk-background-cover uk-height-small header-section"></div>
</section>
<section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
  <div class="uk-container">
    <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-user-friends"></i> <?= $pagetitle; ?></h4>
    <p>To recruit a friend, simply add their account ID on the form and recruit them. The same goes for recruiting you.</p>
    <p>Remember, for the changes to take effect, both must close the game completely and log back in.</p>
    <div class="uk-alert-primary" uk-alert>
      <p>Your account ID is: <?= $id ?></p>
    </div>
    <div class="uk-alert-success" uk-alert>
      <p>Your account has recruited the ID: <?= $recruiter; ?></p>
    </div>
    <?= form_open('', 'id="recruitForm" onsubmit="recruitForm(event)"'); ?>
    <div class="uk-form-controls">
      <div class="uk-inline uk-width-1-1">
        <input class="uk-input" type="number" id="recruit_id" placeholder="ID of the account you want to recruit" required>
        <input type="hidden" class="uk-input" id="account_id" value="<?= $id ?>">
      </div>
    </div>
    <div class="uk-width-1-2@m"></div>
    <div class="uk-margin">
      <div class="uk-form-controls">
        <div class="uk-width-1-4@m">
          <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-user-plus"></i> Recruit a friend</button>
        </div>
      </div>
    </div>
    <?= form_close(); ?>
  </div>
</section>
<script>
  if (Number('<?= $recruiter; ?>') > 0) {
    $.amaran({
      'theme': 'awesome error',
      'content': {
        title: '<?= $this->lang->line('notification_title_error'); ?>',
        message: "<?= $this->lang->line('notification_already_recruited'); ?>",
        info: '',
        icon: 'fas fa-times-circle'
      },
      'delay': 5000,
      'position': 'top right',
      'inEffect': 'slideRight',
      'outEffect': 'slideRight'
    })
    document.getElementById("recruitForm").style.display = "none";
  }

  function recruitForm(e) {
    e.preventDefault();

    var recruit = $('#recruit_id').val();
    var account = $('#account_id').val();

    if (recruit == '') {
      $.amaran({
        'theme': 'awesome warning',
        'content': {
          title: '<?= $this->lang->line('notification_title_warning'); ?>',
          message: "<?= $this->lang->line('notification_id_not_empty'); ?>",
          info: '',
          icon: 'fas fa-times-circle'
        },
        'delay': 5000,
        'position': 'top right',
        'inEffect': 'slideRight',
        'outEffect': 'slideRight'
      })
      return false;
    }

    if (recruit == account) {
      $.amaran({
        'theme': 'awesome warning',
        'content': {
          title: '<?= $this->lang->line('notification_title_warning'); ?>',
          message: "<?= $this->lang->line('notification_not_yourself'); ?>",
          info: '',
          icon: 'fas fa-times-circle'
        },
        'delay': 5000,
        'position': 'top right',
        'inEffect': 'slideRight',
        'outEffect': 'slideRight'
      })
      return false;
    }

    $.ajax({
      url: "<?= base_url($lang . '/recruit/add'); ?>",
      method: "POST",
      data: {
        recruit,
        account
      },
      dataType: "text",

      beforeSend: function() {
        $.amaran({
          'theme': 'awesome info',
          'content': {
            title: '<?= $this->lang->line('notification_title_info'); ?>',
            message: "<?= $this->lang->line('notification_checking'); ?>",
            info: '',
            icon: 'fas fa-sing-in-alt'
          },
          'delay': 5000,
          'position': 'top right',
          'inEffect': 'slideRight',
          'outEffect': 'slideRight'
        })
      },

      success: function(response) {
        if (!response) {
          alert(response);
        }

        if (response == 'accountIDNotFound') {
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: "<?= $this->lang->line('notification_decline_order'); ?>",
              info: '',
              icon: 'fas fa-times-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          })
          $('#recruitForm')[0].reset();
          return false;
        }

        if (response == 'alreadyRecruited') {
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: "<?= $this->lang->line('notification_already_recruited'); ?>",
              info: '',
              icon: 'fas fa-times-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          })
          document.getElementById("recruitForm").style.display = "none";
          return false;
        }

        if (response == 'accountIDFound') {
          $.amaran({
            'theme': 'awesome ok',
            'content': {
              title: '<?= $this->lang->line('notification_title_success'); ?>',
              message: "<?= $this->lang->line('notification_accepted_order'); ?>",
              info: '',
              icon: 'fas fa-check-circle'
            },
            'delay': 5000,
            'position': 'top right',
            'inEffect': 'slideRight',
            'outEffect': 'slideRight'
          });
          $('#recruitForm')[0].reset();
          location.reload();
        }
      }
    });
  }
</script>