<?php
/**
 * First-visit location & language modal.
 *
 * @package smoothmigration
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function smoothmigration_location_language_modal() {
    ?>
    <div class="modal fade" id="localeSelectModal" tabindex="-1" aria-labelledby="localeSelectLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="localeSelectLabel">Choose your location and language</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="sm-country" class="form-label">Location</label>
              <select id="sm-country" class="form-select">
                <option value="">Select your location</option>
                <option value="CA">Canada</option>
                <option value="GB">England</option>
              </select>
            </div>
            <div class="mb-2">
              <label for="sm-language" class="form-label">Language</label>
              <select id="sm-language" class="form-select">
                <option value="en">English</option>
              </select>
            </div>
            <small class="text-muted">We remember your choice for future visits.</small>
          </div>
          <div class="modal-footer">
            <button type="button" id="sm-save-locale" class="btn btn-primary">Continue</button>
          </div>
        </div>
      </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      try {
        const saved = localStorage.getItem('sm_locale');
        if (!saved) {
          const el = document.getElementById('localeSelectModal');
          if (window.bootstrap && el) {
            const m = new bootstrap.Modal(el, { backdrop: 'static', keyboard: false });
            m.show();
            document.getElementById('sm-save-locale').addEventListener('click', function() {
              const country = document.getElementById('sm-country').value || '';
              const language = document.getElementById('sm-language').value || 'en';
              if (!country) { document.getElementById('sm-country').focus(); return; }
              const payload = { country, language, ts: Date.now() };
              localStorage.setItem('sm_locale', JSON.stringify(payload));
              m.hide();
              document.body.setAttribute('data-sm-country', country);
              document.body.setAttribute('data-sm-language', language);
            });
          }
        } else {
          const data = JSON.parse(saved);
          if (data && data.country) {
            document.body.setAttribute('data-sm-country', data.country);
            document.body.setAttribute('data-sm-language', data.language || 'en');
          }
        }
      } catch(e) {}
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'smoothmigration_location_language_modal' );


