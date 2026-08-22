@extends('admin.layouts.app')

@section('title', 'Email Settings')

@section('breadcrumb')
    <li class="breadcrumb-item">Settings</li>
    <li class="breadcrumb-item active">Email</li>
@endsection

@section('content')
    <div class="mb-4">
        <h1 class="page-title">Email Settings</h1>
        <p class="text-muted mb-0">Configure outgoing email server and notification settings</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">SMTP Server Configuration</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.settings.update-email') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="mail_driver" value="smtp">

                        <!-- SMTP Settings -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-8">
                                <label for="mail_host" class="form-label fw-bold">SMTP Host</label>
                                <input type="text" class="form-control" id="mail_host" name="mail_host" 
                                    value="{{ $emailSettings['mail_host'] ?? '' }}" 
                                    placeholder="smtp.example.com">
                            </div>
                            <div class="col-md-4">
                                <label for="mail_port" class="form-label fw-bold">SMTP Port</label>
                                <input type="number" class="form-control" id="mail_port" name="mail_port" 
                                    value="{{ $emailSettings['mail_port'] ?? '' }}" 
                                    placeholder="587">
                            </div>

                            <div class="col-md-6">
                                <label for="mail_username" class="form-label fw-bold">Username</label>
                                <input type="text" class="form-control" id="mail_username" name="mail_username" 
                                    value="{{ $emailSettings['mail_username'] ?? '' }}" 
                                    placeholder="user@example.com">
                            </div>
                            <div class="col-md-6">
                                <label for="mail_password" class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control" id="mail_password" name="mail_password" 
                                    value="{{ $emailSettings['mail_password'] ?? '' }}" 
                                    placeholder="••••••••••••">
                            </div>

                            <div class="col-md-6">
                                <label for="mail_encryption" class="form-label fw-bold">Encryption</label>
                                <select class="form-select" id="mail_encryption" name="mail_encryption">
                                    <option value="tls" {{ ($emailSettings['mail_encryption'] ?? '') === 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ ($emailSettings['mail_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="null" {{ ($emailSettings['mail_encryption'] ?? '') === 'null' ? 'selected' : '' }}>None</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold mb-4">Sender Information</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="mail_from_address" class="form-label fw-bold">From Email Address</label>
                                <input type="email" class="form-control @error('mail_from_address') is-invalid @enderror" 
                                    id="mail_from_address" name="mail_from_address" 
                                    value="{{ $emailSettings['mail_from_address'] ?? '' }}" 
                                    placeholder="noreply@yoursite.com">
                                @error('mail_from_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="mail_from_name" class="form-label fw-bold">From Name</label>
                                <input type="text" class="form-control @error('mail_from_name') is-invalid @enderror" 
                                    id="mail_from_name" name="mail_from_name" 
                                    value="{{ $emailSettings['mail_from_name'] ?? '' }}" 
                                    placeholder="Best Live IPTV">
                                @error('mail_from_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="admin_notification_email" class="form-label fw-bold">Admin Notification Email</label>
                                <input type="email" class="form-control @error('admin_notification_email') is-invalid @enderror" 
                                    id="admin_notification_email" name="admin_notification_email" 
                                    value="{{ $emailSettings['admin_notification_email'] ?? '' }}" 
                                    placeholder="admin@yoursite.com">
                                <div class="form-text">Receive notifications when new orders are placed</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-outline-primary px-4 py-2" onclick="testEmailConnection(event)">
                                <i class="bi bi-send me-2"></i>Test Configuration
                            </button>
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-save me-2"></i>Save Configuration
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function testEmailConnection(e) {
            const adminEmail = document.getElementById('admin_notification_email').value || 
                               document.getElementById('mail_from_address').value || '';
                               
            const testEmail = prompt("Enter email address to receive test mail:", adminEmail);
            if (!testEmail) return;

            const btn = e.currentTarget || e.target;
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Testing...';

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('test_email', testEmail);
            formData.append('mail_host', document.getElementById('mail_host').value);
            formData.append('mail_port', document.getElementById('mail_port').value);
            formData.append('mail_username', document.getElementById('mail_username').value);
            formData.append('mail_password', document.getElementById('mail_password').value);
            formData.append('mail_encryption', document.getElementById('mail_encryption').value);
            formData.append('mail_from_address', document.getElementById('mail_from_address').value);
            formData.append('mail_from_name', document.getElementById('mail_from_name').value);

            fetch('{{ route("admin.settings.test-email") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = originalText;

                if (data.success) {
                    alert("✓ " + (data.message || "Test email sent successfully!"));
                } else {
                    alert("✗ " + (data.error || "Failed to send test email."));
                }
            })
            .catch(error => {
                btn.disabled = false;
                btn.innerHTML = originalText;
                alert("✗ An unexpected error occurred while testing email configuration.");
                console.error('Error:', error);
            });
        }
    </script>
@endsection
