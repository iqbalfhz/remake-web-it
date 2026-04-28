@extends('admin.layouts.app')

@section('title', 'Edit Artikel')

@section('content')
    <div class="max-w-4xl">
        <div class="mb-4">
            <a href="{{ route('admin.artikel.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <form id="artikel-form" method="POST" action="{{ route('admin.artikel.update', $artikel) }}"
            enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Judul: full-width --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Judul Artikel <span
                        class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $artikel->title) }}"
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-stretch">

                {{-- Kolom kiri: Editor --}}
                <div class="lg:col-span-2 flex flex-col">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col flex-1">
                        <div
                            class="px-4 py-2.5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Konten Artikel <span
                                    class="text-red-500">*</span></span>
                            <span class="text-xs text-gray-400 hidden sm:inline">Mendukung gambar, video, dan link</span>
                        </div>
                        <div id="quill-editor" class="flex-1 text-gray-800 dark:text-gray-100"></div>
                        <input type="hidden" name="content" id="quill-content"
                            value="{{ old('content', $artikel->content) }}">
                        @error('content')
                            <p class="px-4 pb-3 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kolom kanan: Sidebar --}}
                <div class="space-y-4">

                    {{-- Ringkasan --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Ringkasan <span
                                class="text-red-500">*</span></label>
                        <textarea name="excerpt" rows="3"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 resize-none @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $artikel->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Publikasi --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 space-y-3">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Publikasi</h3>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">Tanggal
                                Publikasi</label>
                            <input type="datetime-local" name="published_at"
                                value="{{ old('published_at', $artikel->published_at?->format('Y-m-d\TH:i')) }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <p class="mt-1 text-xs text-gray-400">Kosongkan untuk draft.</p>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-semibold rounded-lg transition-colors">
                            Perbarui Artikel
                        </button>
                    </div>

                    {{-- Gambar Sampul --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 space-y-2.5">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Gambar Sampul</h3>
                        @if ($artikel->image)
                            <img src="{{ $artikel->image_url }}" alt="" class="w-full h-28 object-cover rounded-lg">
                        @endif
                        <label
                            class="flex flex-col items-center justify-center gap-1.5 w-full h-16 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 cursor-pointer hover:border-cyan-400 hover:bg-cyan-50/30 dark:hover:bg-cyan-900/10 transition-colors"
                            id="image-drop-area">
                            <span class="text-xs text-gray-400"
                                id="image-label">{{ $artikel->image ? 'Klik untuk ganti gambar' : 'Klik untuk pilih gambar' }}</span>
                            <input type="file" name="image" id="image-input"
                                accept="image/jpg,image/jpeg,image/png,image/webp" class="hidden">
                        </label>
                        <p class="text-xs text-gray-400">JPG, PNG, WebP. Maks 2MB.</p>
                        @error('image')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 space-y-2.5">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Kategori</h3>
                        @php $selectedCats = old('categories', $artikel->categories->pluck('id')->toArray()); @endphp
                        @if ($categories->isEmpty())
                            <p class="text-xs text-gray-400">Belum ada kategori. <a
                                    href="{{ route('admin.kategori.index') }}" class="text-cyan-500 hover:underline">Tambah
                                    kategori</a>.</p>
                        @else
                            <div class="space-y-2 max-h-40 overflow-y-auto pr-1">
                                @foreach ($categories as $cat)
                                    <label class="flex items-center gap-2.5 cursor-pointer group">
                                        <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                            {{ in_array($cat->id, $selectedCats) ? 'checked' : '' }}
                                            class="w-4 h-4 rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                                        <span
                                            class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">{{ $cat->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Tags --}}
                    @php $existingTags = old('tags', $artikel->tags->pluck('name')->toArray()); @endphp
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 space-y-2.5"
                        x-data="{
                            tags: {{ json_encode($existingTags) }},
                            input: '',
                            add() {
                                const val = this.input.trim();
                                if (val && !this.tags.includes(val)) this.tags.push(val);
                                this.input = '';
                            },
                            remove(tag) { this.tags = this.tags.filter(t => t !== tag); }
                        }">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Tags</h3>
                        <div class="flex flex-wrap gap-1.5" x-show="tags.length > 0">
                            <template x-for="tag in tags" :key="tag">
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-cyan-100 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-300 text-xs font-medium">
                                    <span x-text="tag"></span>
                                    <button type="button" @click="remove(tag)"
                                        class="hover:text-red-500 leading-none">&times;</button>
                                    <input type="hidden" :name="'tags[]'" :value="tag">
                                </span>
                            </template>
                        </div>
                        <div class="flex gap-2">
                            <input type="text" x-model="input" @keydown.enter.prevent="add()" @keydown.,.prevent="add()"
                                placeholder="Ketik tag lalu Enter..."
                                class="flex-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <button type="button" @click="add()"
                                class="px-3 py-1.5 text-xs font-medium bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 rounded-lg transition-colors">
                                Tambah
                            </button>
                        </div>
                        <p class="text-xs text-gray-400">Pisahkan dengan Enter atau koma.</p>
                        @error('tags.*')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        const imageUploadUrl = '{{ route('admin.artikel.image') }}';
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Tulis konten artikel di sini...',
            modules: {
                toolbar: {
                    container: [
                        [{
                            header: [1, 2, 3, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }, {
                            indent: '-1'
                        }, {
                            indent: '+1'
                        }],
                        [{
                            align: []
                        }],
                        ['blockquote', 'code-block'],
                        ['link', 'image', 'video'],
                        ['clean'],
                    ],
                    handlers: {
                        image: imageHandler,
                    }
                }
            }
        });

        // Set initial content
        const initialContent = document.getElementById('quill-content').value;
        if (initialContent) {
            quill.clipboard.dangerouslyPasteHTML(initialContent);
        }

        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/png,image/jpeg,image/webp,image/gif');
            input.click();
            input.onchange = async () => {
                const file = input.files[0];
                if (!file) return;
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', csrfToken);
                const response = await fetch(imageUploadUrl, {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                const range = quill.getSelection(true);
                quill.insertEmbed(range.index, 'image', data.url);
                quill.setSelection(range.index + 1);
            };
        }

        document.getElementById('artikel-form').addEventListener('submit', function() {
            document.getElementById('quill-content').value = quill.root.innerHTML;
        });

        // Image file picker label update
        document.getElementById('image-input').addEventListener('change', function() {
            const label = document.getElementById('image-label');
            label.textContent = this.files[0] ? this.files[0].name :
                '{{ $artikel->image ? 'Klik untuk ganti gambar' : 'Klik untuk pilih gambar' }}';
        });
    </script>
    <style>
        #quill-editor .ql-editor {
            min-height: 200px;
            font-size: 0.9rem;
            line-height: 1.75;
        }

        #quill-editor {
            display: flex;
            flex-direction: column;
        }

        #quill-editor .ql-editor {
            flex: 1;
        }

        /* Fix Quill tooltip (video/link) clipped by overflow-hidden parent */
        .ql-container {
            overflow: visible !important;
        }

        .ql-tooltip {
            z-index: 9999;
            white-space: nowrap;
        }
    </style>
@endpush
