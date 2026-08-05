<div>
    @if ($successMessage)
    <div class="mb-6 p-4 rounded-xl flex items-center gap-3"
         style="background: rgba(46,125,50,0.1); border: 1px solid rgba(46,125,50,0.3);">
        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
             style="background: rgba(46,125,50,0.15);">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" style="color: var(--brand-green);">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
        </div>
        <p class="text-sm font-medium" style="color: var(--brand-green);">{{ $successMessage }}</p>
    </div>
    @endif

    <form wire:submit.prevent="submit" class="grid grid-cols-1 gap-5">
        <!-- Name -->
        <div>
            <label for="contact-name" class="block text-sm font-semibold mb-1.5" style="color: var(--text-primary);">
                {{ __('contact.name') }}
            </label>
            <input type="text" id="contact-name" wire:model="name"
                   class="w-full px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200"
                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;"
                   onfocus="this.style.borderColor='var(--brand-blue)'; this.style.boxShadow='0 0 0 3px rgba(19,56,94,0.12)';"
                   onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none';">
            @error('name')
                <span class="text-xs mt-1 block" style="color: #ef4444;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="contact-email" class="block text-sm font-semibold mb-1.5" style="color: var(--text-primary);">
                {{ __('contact.email_label') }}
            </label>
            <input type="email" id="contact-email" wire:model="email"
                   class="w-full px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200"
                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;"
                   onfocus="this.style.borderColor='var(--brand-blue)'; this.style.boxShadow='0 0 0 3px rgba(19,56,94,0.12)';"
                   onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none';">
            @error('email')
                <span class="text-xs mt-1 block" style="color: #ef4444;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Subject -->
        <div>
            <label for="contact-subject" class="block text-sm font-semibold mb-1.5" style="color: var(--text-primary);">
                {{ __('contact.subject') }}
            </label>
            <input type="text" id="contact-subject" wire:model="subject"
                   class="w-full px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200"
                   style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;"
                   onfocus="this.style.borderColor='var(--brand-blue)'; this.style.boxShadow='0 0 0 3px rgba(19,56,94,0.12)';"
                   onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none';">
            @error('subject')
                <span class="text-xs mt-1 block" style="color: #ef4444;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Message -->
        <div>
            <label for="contact-body" class="block text-sm font-semibold mb-1.5" style="color: var(--text-primary);">
                {{ __('contact.message') }}
            </label>
            <textarea id="contact-body" wire:model="body" rows="5"
                      class="w-full px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 resize-none"
                      style="background: var(--surface-bg); border: 1.5px solid var(--border-light); color: var(--text-primary); outline: none;"
                      onfocus="this.style.borderColor='var(--brand-blue)'; this.style.boxShadow='0 0 0 3px rgba(19,56,94,0.12)';"
                      onblur="this.style.borderColor='var(--border-light)'; this.style.boxShadow='none';"></textarea>
            @error('body')
                <span class="text-xs mt-1 block" style="color: #ef4444;">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit"
                wire:loading.attr="disabled"
                class="w-full flex items-center justify-center gap-2 py-3.5 rounded-xl font-bold text-white text-sm transition-all duration-300 disabled:opacity-60"
                style="background: linear-gradient(135deg, var(--brand-blue), var(--brand-blue-light)); box-shadow: 0 4px 14px rgba(19,56,94,0.35);"
                onmouseover="if(!this.disabled) this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 20px rgba(19,56,94,0.45)';"
                onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 14px rgba(19,56,94,0.35)';">
            <span wire:loading.remove>
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                {{ __('contact.send') }}
            </span>
            <span wire:loading class="flex items-center gap-2">
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ __('contact.sending') }}
            </span>
        </button>
    </form>
</div>
