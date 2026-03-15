<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        My Files
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Upload Section -->
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="{{ route('files.upload') }}" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 cursor-pointer transition-all" id="dropZone">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div>
                            <input type="file" id="fileInput" name="file" class="hidden" accept=".pdf,.docx,.txt,.jpg,.png,.zip">
                            <label for="fileInput" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none transition-colors cursor-pointer" style="background-color: #4f46e5; color: white !important;">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Choose Files
                            </label>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">
                            <span id="file-status">PNG, JPG, PDF, DOCX up to 10MB</span>
                        </p>
                        <div id="progress-container" class="mt-4 hidden">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wide" id="upload-label">Uploading...</span>
                                <span class="text-xs font-semibold text-indigo-600" id="upload-percent">0%</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-2">
                                <div id="progress-fill" class="bg-indigo-600 h-2 rounded-full transition-all" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Files Table -->
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Encrypted Vault Inventory</h3>
                @if ($files->isEmpty())
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Vault is Empty</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Your secure storage is ready. Start by uploading a file.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-widest">Document</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-widest">Encryption</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-widest">Size</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-widest">Security Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($files as $file)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="inline-flex items-center justify-center h-10 w-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400">
                                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-white truncate max-w-xs" title="{{ $file->file_name }}">{{ $file->file_name }}</div>
                                                    <div class="text-[10px] text-gray-400 font-mono uppercase tracking-tighter">{{ $file->created_at->format('M d, Y • H:i') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L9.03 1.25c.627-.334 1.378-.334 2.006 0L17.834 4.9C18.528 5.275 19 5.986 19 6.78v3.4c0 4.218-2.607 7.94-6.52 9.32a1.864 1.864 0 01-1.4 0C7.147 18.15 4.54 14.428 4.54 10.211V6.78c0-.795.474-1.505 1.166-1.88zM9.5 7a1 1 0 112 0v2h.75a.75.75 0 01.75.75v3.5a.75.75 0 01-.75.75h-5a.75.75 0 01-.75-.75v-3.5a.75.75 0 01.75-.75H8.5V7z" clip-rule="evenodd"></path></svg>
                                                AES-256 + RSA
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400 font-medium">
                                            {{ number_format($file->file_size / 1024, 1) }} KB
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <button onclick="shareFile({{ $file->id }}, '{{ $file->file_name }}')" class="inline-flex items-center p-2 rounded-lg transition" style="background-color: #d1fae5; color: #065f46 !important;" title="Share File">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                                </button>
                                                <button onclick="viewRaw({{ $file->id }})" class="inline-flex items-center p-2 rounded-lg transition" style="background-color: #fef3c7; color: #92400e !important;" title="View Encryption">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </button>
                                                <a href="{{ route('files.download', $file) }}" class="inline-flex items-center p-2 rounded-lg transition" style="background-color: #e0e7ff; color: #4338ca !important;" title="Secure Download">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                </a>
                                                <form method="POST" action="{{ route('files.destroy', $file) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center p-2 text-red-600 hover:text-red-900 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition" onclick="return confirm('Securely delete this file? This cannot be undone.')" title="Destroy File">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                            
                                            <!-- List currently shared users inline if any -->
                                            @if($file->shares->count() > 0)
                                            <div class="mt-2 text-xs flex flex-wrap justify-end gap-1">
                                                @foreach($file->shares as $share)
                                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-gray-100 text-gray-600 border border-gray-200" title="{{ $share->user->email }}">
                                                        {{ explode('@', $share->user->email)[0] }}
                                                        <form method="POST" action="{{ route('files.share.destroy', [$file, $share->user]) }}" class="inline" onsubmit="return confirm('Revoke access for this user?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="hover:text-red-600"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
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
        dropZone.addEventListener(eventName, () => dropZone.classList.add('highlight'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('highlight'), false);
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
        fileStatus.classList.add('text-indigo-600');
        
        const formData = new FormData();
        formData.append('file', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("files.upload") }}');
        
        // Headers for AJAX
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Accept', 'application/json');

        progressContainer.classList.remove('hidden');
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
        progressContainer.classList.add('hidden');
        progressFill.style.width = '0%';
        fileStatus.textContent = 'PNG, JPG, PDF, DOCX up to 10MB';
        fileStatus.classList.remove('text-indigo-600');
        fileInput.value = '';
    }
}

// Raw Data Viewer logic
function viewRaw(fileId) {
    console.log('viewRaw called for file ID:', fileId);
    const modal = document.getElementById('rawModal');
    const modalFileName = document.getElementById('modalFileName');
    const modalRawData = document.getElementById('modalRawData');
    const modalIV = document.getElementById('modalIV');
    const modalAlgo = document.getElementById('modalAlgo');
    const modalProtection = document.getElementById('modalProtection');

    // Reset and show loading state
    modal.classList.remove('hidden');
    modalFileName.textContent = 'Loading...';
    modalRawData.textContent = 'Fetching encrypted segments from server...';
    modalIV.textContent = 'Computing...';
    modalAlgo.textContent = 'Wait...';
    modalProtection.textContent = 'Wait...';

    const url = "{{ route('files.raw', ':id') }}".replace(':id', fileId) + "?t=" + new Date().getTime();
    console.log('Fetching from ABSOLUTE URL:', url);

    fetch(url, {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Response Status:', response.status);
        if (!response.ok) {
            throw new Error('Server returned ' + response.status + ': ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Data received:', data);
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
        console.error('Fetch error:', error);
        alert('Encryption Inspector Failed: ' + error.message);
        closeModal();
    });
}

function closeModal() {
    document.getElementById('rawModal').classList.add('hidden');
}

initFileUpload();
</script>

<style>
#dropZone.highlight {
    border-color: #4f46e5;
    background-color: #f5f3ff;
}

#dropZone.highlight svg {
    color: #4f46e5;
}
</style>

<!-- Raw Encryption Modal -->
<div id="rawModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden flex flex-col border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between bg-gray-50 dark:bg-gray-900/50">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-lg">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white" id="modalFileName">Loading...</h3>
            </div>
        <button onclick="closeModal()" class="p-2 rounded-full hover:bg-gray-200 transition" style="color: #6b7280; background-color: #f3f4f6;">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        </div>
        <div class="p-8 overflow-y-auto space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800">
                    <div class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest mb-1">Primary Algorithm</div>
                    <div class="text-indigo-700 dark:text-indigo-300 font-mono font-bold" id="modalAlgo">AES-256-CBC</div>
                </div>
                <div class="bg-emerald-50 dark:bg-emerald-900/20 p-4 rounded-xl border border-emerald-100 dark:border-emerald-800">
                    <div class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest mb-1">Key Protection</div>
                    <div class="text-emerald-700 dark:text-emerald-300 font-mono font-bold" id="modalProtection">RSA-2048 (OAEP)</div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Initialization Vector (IV)</label>
                <div class="bg-gray-50 dark:bg-gray-900 p-3 rounded-lg font-mono text-xs break-all border border-gray-100 dark:border-gray-800 text-gray-600 dark:text-gray-400" id="modalIV">
                    Retrieving...
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Raw Encrypted Data (Preview)</label>
                <div class="bg-gray-900 text-green-400 p-4 rounded-xl font-mono text-xs break-all min-h-[150px] border border-gray-800 select-all" id="modalRawData">
                    Decrypting from storage...
                </div>
                <p class="mt-2 text-[10px] text-gray-500 italic">This is exactly how your file looks while sitting on the server's hard drive. Without the correct RSA keys, this data is useless garbage.</p>
            </div>
        </div>
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex justify-end">
            <button onclick="closeModal()" class="px-6 py-2 hover:bg-indigo-700 text-white font-bold rounded-lg transition-all shadow-lg" style="background-color: #4f46e5; color: white !important;">
                Close Inspector
            </button>
        </div>
    </div>
</div>

</div>

<!-- Share Modal -->
<div id="shareModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden flex flex-col border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex flex-col">
            <h3 class="text-lg font-bold text-gray-900 mb-1">Share File</h3>
            <p class="text-xs text-gray-500 font-mono truncate" id="shareFileName"></p>
        </div>
        <form method="POST" id="shareForm" class="p-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Recipient Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                    </div>
                    <input type="email" name="email" id="email" required placeholder="user@example.com" class="block w-full pl-10 sm:text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <p class="mt-2 text-xs text-gray-500">The recipient must have a registered account.</p>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeShareModal()" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Share Securely</button>
            </div>
        </form>
    </div>
</div>

<script>
    function shareFile(fileId, fileName) {
        document.getElementById('shareModal').classList.remove('hidden');
        document.getElementById('shareFileName').textContent = fileName;
        document.getElementById('shareForm').action = "/files/" + fileId + "/share";
    }

    function closeShareModal() {
        document.getElementById('shareModal').classList.add('hidden');
        document.getElementById('shareForm').reset();
    }
</script>

</x-app-layout>
