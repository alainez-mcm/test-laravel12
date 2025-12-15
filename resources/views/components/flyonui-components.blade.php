<x-layout>
  <div class="p-8">
    <a href="{{ route('home') }}">
        <h2 class="mb-6 text-xl font-bold flex items-center gap-2">
            <x-icons.flyonui />
            <span>FlyonUI Components</span>
        </h2>
    </a>

    <div class="grid gap-4 lg:grid-cols-2">
      <div class="flex flex-col gap-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-2.5">Buttons</h5>
            <div class="flex flex-wrap gap-2">
              <button class="btn">Default</button>
              <button class="btn btn-primary">Primary</button>
              <button class="btn btn-secondary">Secondary</button>
              <button class="btn btn-accent">Accent</button>
              <button class="btn btn-info">Info</button>
              <button class="btn btn-success">Success</button>
              <button class="btn btn-warning">Warning</button>
              <button class="btn btn-error">Error</button>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-2.5">Alert</h5>
            <div class="space-y-2">
              <div class="alert alert-primary" role="alert">Stay tuned for our upcoming events and announcements.</div>
              <div class="alert alert-primary alert-soft" role="alert">
                Your transaction was successful. Thank you for choosing our service!
              </div>
              <div class="alert alert-primary alert-outline" role="alert">
                Attention! Your account security may be at risk. Enable two-factor authentication now.
              </div>
              <div class="alert alert-primary alert-outline border-dashed" role="alert">
                Oops! It seems there was an unexpected error. Please try again later.
              </div>
              <div class="alert alert-soft alert-primary removing:translate-x-5 removing:opacity-0 flex items-center gap-4 transition duration-300 ease-in-out" role="alert" id="dismiss-alert1">
                Dive into our platform to discover exciting new features and updates.
                <button class="ms-auto cursor-pointer leading-none" data-remove-element="#dismiss-alert1" aria-label="Close Button">
                  <span class="icon-[tabler--x] size-5"></span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-6">
          <div class="card-body">
            <h5 class="card-title mb-2.5">JS Components</h5>
            <div class="flex flex-wrap gap-4">
              <div>
                <button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="basic-modal" data-overlay="#basic-modal" >
                  Open modal
                </button>
                <div id="basic-modal" class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 hidden" role="dialog" tabindex="-1" >
                  <div class="modal-dialog overlay-open:opacity-100 overlay-open:duration-300">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">Dialog Title</h3>
                        <button
                          type="button"
                          class="btn btn-text btn-circle btn-sm absolute end-3 top-3"
                          aria-label="Close"
                          data-overlay="#basic-modal"
                        >
                          <span class="icon-[tabler--x] size-4"></span>
                        </button>
                      </div>
                      <div class="modal-body"> This is some placeholder content to show the scrolling behavior for modals. Instead of repeating the text in the modal, we use an inline style to set a minimum height, thereby extending the length of the overall modal and demonstrating the overflow scrolling. When content becomes longer than the height of the viewport, scrolling will move the modal as needed. </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-soft btn-secondary" data-overlay="#basic-modal">
                          Close
                        </button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div>
                <div class="dropdown relative inline-flex">
                  <button id="dropdown-default" type="button" class="dropdown-toggle btn btn-primary" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown" >
                    Dropdown
                    <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-default" >
                    <li><a class="dropdown-item" href="#">My Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Billing</a></li>
                    <li><a class="dropdown-item" href="#">FAQs</a></li>
                  </ul>
                </div>
              </div>

              <div>
                <div class="tooltip">
                  <button type="button" class="tooltip-toggle btn btn-square btn-primary" aria-label="Tooltip">
                    <span class="icon-[tabler--chevron-up]"></span>
                  </button>
                  <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                    <span class="tooltip-body tooltip-primary">Tooltip</span>
                  </span>
                </div>
              </div>

              <div class="max-w-sm grow">
                <select
                  data-select='{
                    "placeholder": "Select option...",
                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                    "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                    "dropdownClasses": "advance-select-menu",
                    "optionClasses": "advance-select-option selected:select-active",
                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                    "extraMarkup": "<span class=\"icon-[tabler--caret-up-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                    }'
                  class="hidden"
                >
                  <option value="">Choose</option>
                  <option value="name">Full Name</option>
                  <option value="email">Email Address</option>
                  <option value="description">Project Description</option>
                  <option value="user_id">User Identification Number</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="">
        <div class="bg-base-100 shadow-base-300/20 w-full rounded-lg shadow-sm">
          <div class="w-full p-4">
            <form class="needs-validation peer grid gap-y-4" novalidate>
              <!-- Account Details -->
              <div class="w-full">
                <h6 class="text-lg font-semibold">1. Account Details</h6>
                <hr class="mt-2 mb-4" />
              </div>
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <label class="label-text" for="firstName">First Name</label>
                  <input id="firstName" type="text" placeholder="John" class="input" required />
                </div>
                <div>
                  <label class="label-text" for="lastName">Last Name</label>
                  <input id="lastName" type="text" placeholder="Doe" class="input" required />
                </div>
              </div>
              <!-- Email and password -->
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <label class="label-text" for="userEmail">Email</label>
                  <input
                    id="userEmail"
                    type="email"
                    class="input"
                    placeholder="john@gmail.com"
                    aria-label="john@gmail.com"
                    required=""
                  />
                </div>
                <div>
                  <label class="label-text" for="userPassword">Password</label>
                  <div class="input">
                    <input id="userPassword" type="password" class="grow" placeholder="Enter password" required />
                    <button
                      type="button"
                      data-toggle-password='{ "target": "#userPassword" }'
                      class="my-auto ms-4 block cursor-pointer"
                    >
                      <span
                        class="icon-[tabler--eye] text-base-content/80 password-active:block hidden size-4 shrink-0"
                      ></span>
                      <span
                        class="icon-[tabler--eye-off] text-base-content/80 password-active:hidden block size-4 shrink-0"
                      ></span>
                    </button>
                  </div>
                </div>
              </div>
              <!-- Personal Info -->
              <div class="w-full">
                <h6 class="text-lg font-semibold">2. Personal Info</h6>
                <hr class="mt-2 mb-4" />
              </div>
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <label class="label-text" for="userProfile">Profile Pic</label>
                  <input id="userProfile" type="file" class="input" required />
                </div>
                <div>
                  <label class="label-text" for="jsPickr">DOB</label>
                  <input id="jsPickr" type="date" class="input" placeholder="YYYY-MM-DD" id="jsPickr" required />
                </div>
              </div>
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <label class="label-text" for="userCountry">Pick your Country</label>
                  <select class="select" id="userCountry" aria-label="Select Country" required>
                    <option value="">Select Country</option>
                    <option value="usa">USA</option>
                    <option value="uk">UK</option>
                    <option value="france">France</option>
                    <option value="australia">Australia</option>
                    <option value="spain">Spain</option>
                  </select>
                </div>
                <div>
                  <div class="label-text">Gender</div>
                  <div class="flex items-center gap-2">
                    <input type="radio" id="male" name="radio-0" class="radio radio-primary" required />
                    <label class="label-text text-base" for="male">Male</label>
                  </div>
                  <div class="flex items-center gap-2">
                    <input type="radio" id="female" name="radio-0" class="radio radio-primary" required />
                    <label class="label-text text-base" for="female">Female</label>
                  </div>
                </div>
              </div>
              <div class="w-full">
                <label class="label-text" for="userBio">Bio</label>
                <textarea
                  class="textarea min-h-20 resize-none"
                  id="userBio"
                  placeholder="Hello!!!"
                  required=""
                ></textarea>
              </div>
              <div>
                <div class="flex items-center gap-3">
                  <input type="checkbox" id="userSwitch" class="switch switch-primary" required />
                  <label class="label-text text-base" for="userSwitch">Send me related emails</label>
                </div>
              </div>
              <div>
                <div class="flex items-center gap-3">
                  <input type="checkbox" class="checkbox checkbox-primary" id="userAgre" required />
                  <label class="label-text text-base" for="userAgre">Agree to our terms and conditions</label>
                </div>
              </div>
              <!-- Submit button -->
              <div class="mt-4">
                <button type="submit" name="submitButton" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>
