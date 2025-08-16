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
        const EXPIRY_DAYS = 30;
        const saved = localStorage.getItem('sm_locale');
        let shouldShowModal = true;
        
        if (saved) {
          const data = JSON.parse(saved);
          if (data && data.country) {
            // Check if data has expired (30 days)
            const savedTime = data.ts || 0;
            const currentTime = Date.now();
            const daysPassed = (currentTime - savedTime) / (1000 * 60 * 60 * 24);
            
            if (daysPassed < EXPIRY_DAYS) {
              shouldShowModal = false;
              document.body.setAttribute('data-sm-country', data.country);
              document.body.setAttribute('data-sm-language', data.language || 'en');
            } else {
              // Data expired, clear it
              localStorage.removeItem('sm_locale');
            }
          }
        }
        
        if (shouldShowModal) {
          const el = document.getElementById('localeSelectModal');
          if (window.bootstrap && el) {
            const m = new bootstrap.Modal(el, { backdrop: true, keyboard: true });
            m.show();
            
            // Save button handler
            document.getElementById('sm-save-locale').addEventListener('click', function() {
              const country = document.getElementById('sm-country').value || '';
              const language = document.getElementById('sm-language').value || 'en';
              if (!country) { 
                document.getElementById('sm-country').focus(); 
                return; 
              }
              const payload = { 
                country, 
                language, 
                ts: Date.now() 
              };
              localStorage.setItem('sm_locale', JSON.stringify(payload));
              m.hide();
              document.body.setAttribute('data-sm-country', country);
              document.body.setAttribute('data-sm-language', language);
            });
            
            // Also save when modal is dismissed (close button or backdrop click)
            el.addEventListener('hidden.bs.modal', function () {
              // If no selection was made, save a "dismissed" state
              if (!localStorage.getItem('sm_locale')) {
                const payload = { 
                  country: 'US', // Default to US
                  language: 'en',
                  dismissed: true,
                  ts: Date.now() 
                };
                localStorage.setItem('sm_locale', JSON.stringify(payload));
                document.body.setAttribute('data-sm-country', 'US');
                document.body.setAttribute('data-sm-language', 'en');
              }
            });
          }
        }
      } catch(e) {
        console.error('Locale modal error:', e);
      }
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'smoothmigration_location_language_modal' );



