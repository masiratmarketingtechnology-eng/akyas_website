<!-- Quote Modal -->
<div class="quote-modal" id="quoteModal">
    <div class="quote-modal__overlay" onclick="closeQuoteModal()"></div>
    <div class="quote-modal__content">
        <button class="quote-modal__close" onclick="closeQuoteModal()" aria-label="Close">&times;</button>
        <div class="quote-modal__header">
            <span class="eyebrow">Get In Touch</span>
            <h2>Request a Quote</h2>
            <p>Fill out the form below and our team will get back to you shortly.</p>
        </div>
        @if(session('success'))
            <div class="alert alert--success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert--error">{{ $errors->first() }}</div>
        @endif
        <form class="enquiry-form" method="POST" action="{{ route('contact.store') }}" id="quoteForm">
            @csrf
            <div class="form-row">
                <label><span class="label-text">Full Name <span class="required">*</span></span><input type="text" name="full_name" value="{{ old('full_name') }}" required></label>
                <label><span class="label-text">Company Name</span><input type="text" name="company_name" value="{{ old('company_name') }}"></label>
            </div>
            <div class="form-row">
                <label><span class="label-text">Email <span class="required">*</span></span><input type="email" name="email" value="{{ old('email') }}" required></label>
                <label><span class="label-text">Phone</span><input type="tel" name="phone" value="{{ old('phone') }}"></label>
            </div>
            <label><span class="label-text">Subject / Product Interest</span>
                <select name="subject">
                    <option value="">Select a Category</option>
                    <option value="Jumbo Bags">Jumbo Bags</option>
                    <option value="PP Woven Sacks">PP Woven Sacks</option>
                    <option value="Container Liners">Container Liners</option>
                    <option value="Custom Specification">Custom Specification</option>
                </select>
            </label>
            <label><span class="label-text">Message <span class="required">*</span></span><textarea name="message" rows="4" required placeholder="Tell us about your requirements...">{{ old('message') }}</textarea></label>
            <div class="button-row">
                <button class="button button--primary" type="submit">Send Enquiry <i class="fa-solid fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>

<script>
function openQuoteModal(e) {
    if (e) e.preventDefault();
    document.getElementById('quoteModal').classList.add('is-open');
    document.body.style.overflow = 'hidden';
}

function closeQuoteModal() {
    document.getElementById('quoteModal').classList.remove('is-open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeQuoteModal();
});
</script>
