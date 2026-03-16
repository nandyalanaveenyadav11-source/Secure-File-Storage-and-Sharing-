<x-app-layout>
<x-slot name="header">
    <h2 style="font-size: 1.25rem; font-weight: 600; color: var(--color-gray-800);">
        My Files
    </h2>
</x-slot>

<div style="padding-top: 3rem; padding-bottom: 3rem;">
    <div class="container">
        <!-- Upload Section -->
        <div class="card" style="margin-bottom: 2rem;">
            <div class="card-body">
                <form method="POST" action="{{ route('files.upload') }}" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div id="dropZone" style="border: 2px dashed var(--color-gray-300); border-radius: var(--radius-lg); padding: 2rem; text-align: center; transition: all var(--transition-fast); cursor: pointer;">
                        <svg style="margin: 0 auto 1rem auto; width: 3rem; height: 3rem; color: var(--color-gray-400);" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div>
                            <input type="file" id="fileInput" name="file" style="display: none;" accept=".pdf,.docx,.txt,.jpg,.png,.zip">
                            <label for="fileInput" class="btn btn-primary" style="display: inline-flex; cursor: pointer;">
                                <svg style="margin-left: -0.25rem; margin-right: 0.5rem; width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Choose Files
                            </label>
                        </div>
                        <p style="margin-top: 0.5rem; font-size: 0.875rem; color: var(--color-gray-500);">
                            <span id="file-status">PNG, JPG, PDF, DOCX up to 10MB</span>
                        </p>
                        <div id="progress-container" style="display: none; margin-top: 1rem;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.25rem;">
                                <span style="font-size: 0.75rem; font-weight: 600; color: var(--color-primary-600); text-transform: uppercase; letter-spacing: 0.05em;" id="upload-label">Uploading...</span>
                                <span style="font-size: 0.75rem; font-weight: 600; color: var(--color-primary-600);" id="upload-percent">0%</span>
                            </div>
                            <div style="background-color: var(--color-gray-200); border-radius: var(--radius-full); height: 0.5rem;">
                                <div id="progress-fill" style="background-color: var(--color-primary-600); height: 0.5rem; border-radius: var(--radius-full); transition: all 0.2s ease; width: 0%;"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Files Table -->
        <div class="card">
            <div class="card-header">
                <h3 style="font-size: 1.125rem; font-weight: 500; color: var(--color-gray-900);">Encrypted Vault Inventory</h3>
            </div>
            <div class="card-body" style="padding: 0;">
                @if ($files->isEmpty())
                    <div style="text-align: center; padding: 3rem 0;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 5rem; height: 5rem; background-color: var(--color-gray-100); border-radius: var(--radius-full); margin-bottom: 1rem;">
                            <svg style="width: 2.5rem; height: 2.5rem; color: var(--color-gray-400);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 style="font-size: 0.875rem; font-weight: 500; color: var(--color-gray-900);">Vault is Empty</h3>
                        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: var(--color-gray-500);">Your secure storage is ready. Start by uploading a file.</p>
                    </div>
                @else
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; min-width: 100%; border-collapse: collapse; text-align: left;">
                            <thead style="background-color: var(--color-gray-50); border-bottom: 1px solid var(--color-gray-200);">
                                <tr>
                                    <th style="padding: 0.75rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Document</th>
                                    <th style="padding: 0.75rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Encryption</th>
                                    <th style="padding: 0.75rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Size</th>
                                    <th style="padding: 0.75rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Security Actions</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: var(--color-white);">
                                @foreach ($files as $file)
                                    <tr style="border-bottom: 1px solid var(--color-gray-200); transition: background-color var(--transition-fast);" onmouseover="this.style.backgroundColor='var(--color-gray-50)'" onmouseout="this.style.backgroundColor='transparent'">
                                        <td style="padding: 1rem 1.5rem; white-space: nowrap;">
                                            <div style="display: flex; align-items: center;">
                                                <div style="flex-shrink: 0; width: 2.5rem; height: 2.5rem;">
                                                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 100%; border-radius: var(--radius-lg); background-color: var(--color-primary-50); color: var(--color-primary-600);">
                                                        <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div style="margin-left: 1rem;">
                                                    <div style="font-size: 0.875rem; font-weight: 600; color: var(--color-gray-900); max-width: 16rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $file->file_name }}">{{ $file->file_name }}</div>
                                                    <div style="font-size: 0.625rem; color: var(--color-gray-400); font-family: monospace; text-transform: uppercase; letter-spacing: -0.05em;">{{ $file->created_at->format('M d, Y • H:i') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 1rem 1.5rem; white-space: nowrap;">
                                            <span style="display: inline-flex; align-items: center; padding: 0.125rem 0.625rem; border-radius: var(--radius-full); font-size: 0.75rem; font-weight: 500; background-color: #d1fae5; color: #065f46;">
                                                <svg style="width: 0.75rem; height: 0.75rem; margin-right: 0.25rem;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L9.03 1.25c.627-.334 1.378-.334 2.006 0L17.834 4.9C18.528 5.275 19 5.986 19 6.78v3.4c0 4.218-2.607 7.94-6.52 9.32a1.864 1.864 0 01-1.4 0C7.147 18.15 4.54 14.428 4.54 10.211V6.78c0-.795.474-1.505 1.166-1.88zM9.5 7a1 1 0 112 0v2h.75a.75.75 0 01.75.75v3.5a.75.75 0 01-.75.75h-5a.75.75 0 01-.75-.75v-3.5a.75.75 0 01.75-.75H8.5V7z" clip-rule="evenodd"></path></svg>
                                                AES-256 + RSA
                                            </span>
                                        </td>
                                        <td style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: var(--color-gray-600); font-weight: 500;">
                                            {{ number_format($file->file_size / 1024, 1) }} KB
                                        </td>
                                        <td style="padding: 1rem 1.5rem; white-space: nowrap; text-align: right; font-size: 0.875rem; font-weight: 500;">
                                            <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                                <button onclick="shareFile({{ $file->id }}, '{{ $file->file_name }}')" style="display: inline-flex; align-items: center; padding: 0.5rem; border-radius: var(--radius-lg); background-color: #d1fae5; color: #065f46; transition: background-color 0.2s; border: none; cursor: pointer;" title="Share File">
                                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                                </button>
                                                <button onclick="viewRaw({{ $file->id }})" style="display: inline-flex; align-items: center; padding: 0.5rem; border-radius: var(--radius-lg); background-color: #fef3c7; color: #92400e; transition: background-color 0.2s; border: none; cursor: pointer;" title="View Encryption">
                                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </button>
                                                <a href="{{ route('files.download', $file) }}" style="display: inline-flex; align-items: center; padding: 0.5rem; border-radius: var(--radius-lg); background-color: #e0e7ff; color: #4338ca; transition: background-color 0.2s;" title="Secure Download">
                                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                </a>
                                                <form method="POST" action="{{ route('files.destroy', $file) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.5rem; color: #dc2626; border-radius: var(--radius-lg); transition: all 0.2s; border: none; background: transparent; cursor: pointer;" onmouseover="this.style.backgroundColor='#fee2e2'" onmouseout="this.style.backgroundColor='transparent'" onclick="return confirm('Securely delete this file? This cannot be undone.')" title="Destroy File">
                                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                            
                                            <!-- List currently shared users inline if any -->
                                            @if($file->shares->count() > 0)
                                            <div style="margin-top: 0.5rem; font-size: 0.75rem; display: flex; flex-wrap: wrap; justify-content: flex-end; gap: 0.25rem;">
                                                @foreach($file->shares as $share)
                                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); background-color: var(--color-gray-100); color: var(--color-gray-600); border: 1px solid var(--color-gray-200);" title="{{ $share->user->email }}">
                                                        {{ explode('@', $share->user->email)[0] }}
                                                        <form method="POST" action="{{ route('files.share.destroy', [$file, $share->user]) }}" style="display: inline;" onsubmit="return confirm('Revoke access for this user?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="color: inherit; background: none; border: none; cursor: pointer; padding: 0;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='inherit'"><svg style="width: 0.75rem; height: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                                                        </form>
                                                    </span>
                                                @endforeach
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function initFileUpload() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const progressFill = document.getElementById('progress-fill');
    const progressContainer = document.getElementById('progress-container');
    const fileStatus = document.getElementById('file-status');
    const uploadLabel = document.getElementById('upload-label');
    const uploadPercent = document.getElementById('upload-percent');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.borderColor = 'var(--color-primary-600)';
            dropZone.style.backgroundColor = 'var(--color-primary-50)';
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.borderColor = 'var(--color-gray-300)';
            dropZone.style.backgroundColor = 'transparent';
        }, false);
    });

    dropZone.addEventListener('drop', handleDrop, false);

    fileInput.addEventListener('change', handleFiles);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFiles();
        }
    }

    function handleFiles() {
        if (fileInput.files.length === 0) return;

        const file = fileInput.files[0];
        fileStatus.innerHTML = `<strong>Selected:</strong> ${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
        fileStatus.style.color = 'var(--color-primary-600)';
        
        const formData = new FormData();
        formData.append('file', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("files.upload") }}');
        
        // Headers for AJAX
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Accept', 'application/json');

        progressContainer.style.display = 'block';
        uploadLabel.textContent = "Uploading & Encrypting...";

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = Math.round((e.loaded / e.total) * 100);
                progressFill.style.width = percentComplete + '%';
                uploadPercent.textContent = percentComplete + '%';
            }
        });

        xhr.onload = function() {
            try {
                const response = JSON.parse(xhr.responseText);
                if (xhr.status >= 200 && xhr.status < 300) {
                    uploadLabel.textContent = "Success!";
                    setTimeout(() => location.reload(), 500);
                } else {
                    alert('Upload failed: ' + (response.error || xhr.statusText));
                    resetUI();
                }
            } catch (e) {
                alert('Upload failed: Unexpected server response');
                resetUI();
            }
        };

        xhr.onerror = function() {
            alert('Upload failed: Network error');
            resetUI();
        };

        xhr.send(formData);
    }

    function resetUI() {
        progressContainer.style.display = 'none';
        progressFill.style.width = '0%';
        fileStatus.textContent = 'PNG, JPG, PDF, DOCX up to 10MB';
        fileStatus.style.color = 'var(--color-gray-500)';
        fileInput.value = '';
    }
}

// Raw Data Viewer logic
function viewRaw(fileId) {
    const modal = document.getElementById('rawModal');
    const modalFileName = document.getElementById('modalFileName');
    const modalRawData = document.getElementById('modalRawData');
    const modalIV = document.getElementById('modalIV');
    const modalAlgo = document.getElementById('modalAlgo');
    const modalProtection = document.getElementById('modalProtection');

    // Reset and show loading state
    modal.style.display = 'flex';
    modalFileName.textContent = 'Loading...';
    modalRawData.textContent = 'Fetching encrypted segments from server...';
    modalIV.textContent = 'Computing...';
    modalAlgo.textContent = 'Wait...';
    modalProtection.textContent = 'Wait...';

    const url = "{{ route('files.raw', ':id') }}".replace(':id', fileId) + "?t=" + new Date().getTime();

    fetch(url, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Server returned ' + response.status + ': ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            alert('Server Error: ' + data.error);
            closeModal();
            return;
        }
        modalFileName.textContent = data.file_name || 'Unknown File';
        modalRawData.textContent = data.encrypted_data_preview || 'No data';
        modalIV.textContent = data.iv || 'No IV';
        modalAlgo.textContent = data.algorithm || 'AES-256-CBC';
        modalProtection.textContent = data.key_protection || 'RSA-2048';
    })
    .catch(error => {
        alert('Encryption Inspector Failed: ' + error.message);
        closeModal();
    });
}

function closeModal() {
    document.getElementById('rawModal').style.display = 'none';
}

initFileUpload();
</script>

<!-- Raw Encryption Modal -->
<div id="rawModal" style="display: none; position: fixed; inset: 0; background-color: rgba(17, 24, 39, 0.5); backdrop-filter: blur(4px); z-index: 50; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background-color: var(--color-white); border-radius: 1rem; box-shadow: var(--shadow-xl); max-width: 56rem; width: 100%; max-height: 90vh; overflow: hidden; display: flex; flex-direction: column; border: 1px solid var(--color-gray-200);">
        <div style="padding: 1rem 1.5rem; border-bottom: 1px solid var(--color-gray-200); display: flex; align-items: center; justify-content: space-between; background-color: var(--color-gray-50);">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="padding: 0.5rem; background-color: #fef3c7; color: #d97706; border-radius: var(--radius-lg);">
                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--color-gray-900);" id="modalFileName">Loading...</h3>
            </div>
            <button onclick="closeModal()" style="padding: 0.5rem; border-radius: var(--radius-full); cursor: pointer; color: #6b7280; background-color: #f3f4f6; border: none;" onmouseover="this.style.backgroundColor='#e5e7eb'" onmouseout="this.style.backgroundColor='#f3f4f6'">
                <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div style="padding: 2rem; overflow-y: auto; display: flex; flex-direction: column; gap: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr; gap: 1rem; @media (min-width: 768px) { grid-template-columns: repeat(2, 1fr); }">
                <div style="background-color: var(--color-primary-50); padding: 1rem; border-radius: var(--radius-xl); border: 1px solid var(--color-primary-100);">
                    <div style="font-size: 0.625rem; font-weight: 700; color: var(--color-primary-600); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Primary Algorithm</div>
                    <div style="color: var(--color-primary-700); font-family: monospace; font-weight: 700;" id="modalAlgo">AES-256-CBC</div>
                </div>
                <div style="background-color: #ecfdf5; padding: 1rem; border-radius: var(--radius-xl); border: 1px solid #d1fae5;">
                    <div style="font-size: 0.625rem; font-weight: 700; color: #10b981; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Key Protection</div>
                    <div style="color: #047857; font-family: monospace; font-weight: 700;" id="modalProtection">RSA-2048 (OAEP)</div>
                </div>
            </div>

            <div>
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--color-gray-400); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Initialization Vector (IV)</label>
                <div style="background-color: var(--color-gray-50); padding: 0.75rem; border-radius: var(--radius-lg); font-family: monospace; font-size: 0.75rem; word-break: break-all; border: 1px solid var(--color-gray-200); color: var(--color-gray-600);" id="modalIV">
                    Retrieving...
                </div>
            </div>

            <div>
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--color-gray-400); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Raw Encrypted Data (Preview)</label>
                <div style="background-color: var(--color-gray-900); color: #4ade80; padding: 1rem; border-radius: var(--radius-xl); font-family: monospace; font-size: 0.75rem; word-break: break-all; min-height: 150px; border: 1px solid var(--color-gray-800); user-select: all;" id="modalRawData">
                    Decrypting from storage...
                </div>
                <p style="margin-top: 0.5rem; font-size: 0.625rem; color: var(--color-gray-500); font-style: italic;">This is exactly how your file looks while sitting on the server's hard drive. Without the correct RSA keys, this data is useless garbage.</p>
            </div>
        </div>
        <div style="padding: 1rem 1.5rem; background-color: var(--color-gray-50); border-top: 1px solid var(--color-gray-200); display: flex; justify-content: flex-end;">
            <button onclick="closeModal()" class="btn btn-primary">
                Close Inspector
            </button>
        </div>
    </div>
</div>

<!-- Share Modal -->
<div id="shareModal" style="display: none; position: fixed; inset: 0; background-color: rgba(17, 24, 39, 0.5); backdrop-filter: blur(4px); z-index: 50; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background-color: var(--color-white); border-radius: 1rem; box-shadow: var(--shadow-xl); max-width: 28rem; width: 100%; overflow: hidden; display: flex; flex-direction: column; border: 1px solid var(--color-gray-200);">
        <div style="padding: 1rem 1.5rem; border-bottom: 1px solid var(--color-gray-200); background-color: var(--color-gray-50); display: flex; flex-direction: column;">
            <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--color-gray-900); margin-bottom: 0.25rem;">Share File</h3>
            <p style="font-size: 0.75rem; color: var(--color-gray-500); font-family: monospace; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" id="shareFileName"></p>
        </div>
        <form method="POST" id="shareForm" style="padding: 1.5rem;">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Recipient Email</label>
                <div style="position: relative;">
                    <input type="email" name="email" id="email" required placeholder="user@example.com" class="form-input">
                </div>
                <p style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--color-gray-500);">The recipient must have a registered account.</p>
            </div>
            <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="button" onclick="closeShareModal()" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Share Securely</button>
            </div>
        </form>
    </div>
</div>

<script>
    function shareFile(fileId, fileName) {
        document.getElementById('shareModal').style.display = 'flex';
        document.getElementById('shareFileName').textContent = fileName;
        document.getElementById('shareForm').action = "/files/" + fileId + "/share";
    }

    function closeShareModal() {
        document.getElementById('shareModal').style.display = 'none';
        document.getElementById('shareForm').reset();
    }
</script>
</x-app-layout>
