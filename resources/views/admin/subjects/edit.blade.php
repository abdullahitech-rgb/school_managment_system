@extends('layouts.admin')

@section('title', 'Edit Subject')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 d-inline-block">Edit Subject</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Subject Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST" id="subjectForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Subject Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $subject->code) }}" required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Subject Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $subject->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
                            <select class="form-select @error('class_id') is-invalid @enderror" id="class_id" name="class_id" required>
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id', $subject->class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="section_ids" class="form-label">Assign to Sections <span class="text-danger">*</span></label>
                            <select class="form-select @error('section_ids') is-invalid @enderror" id="section_ids" name="section_ids[]" multiple required>
                                <option value="" disabled>Select sections</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}" {{ in_array($section->id, old('section_ids', $selectedSectionIds)) ? 'selected' : '' }}>
                                        {{ $section->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold Ctrl/Cmd to select multiple sections</small>
                            @error('section_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $subject->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Subject
                            </button>
                            <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('class_id').addEventListener('change', function() {
    const classId = this.value;
    const sectionSelect = document.getElementById('section_ids');

    sectionSelect.innerHTML = '<option value="" disabled>Loading...</option>';

    if (!classId) {
        sectionSelect.innerHTML = '<option value="" disabled>Select a class first</option>';
        sectionSelect.disabled = true;
        return;
    }

    sectionSelect.disabled = false;

    fetch(`{{ url('admin/class') }}/${classId}/sections`)
        .then(response => response.json())
        .then(sections => {
            sectionSelect.innerHTML = '';
            if (sections.length === 0) {
                sectionSelect.innerHTML = '<option value="">No sections available for this class</option>';
                return;
            }
            sections.forEach(section => {
                const option = document.createElement('option');
                option.value = section.id;
                option.textContent = section.name;

                // Check if this section was previously selected
                if ({{ json_encode($selectedSectionIds) }}.includes(section.id)) {
                    option.selected = true;
                }

                sectionSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            sectionSelect.innerHTML = '<option value="">Error loading sections</option>';
        });
});

// Initialize on page load
window.addEventListener('DOMContentLoaded', function() {
    const classSelect = document.getElementById('class_id');
    if (classSelect.value) {
        classSelect.dispatchEvent(new Event('change'));
    }
});

// Validate that at least one section is selected
document.getElementById('subjectForm').addEventListener('submit', function(e) {
    const sectionSelect = document.getElementById('section_ids');
    if (!sectionSelect.value || sectionSelect.value.length === 0) {
        e.preventDefault();
        alert('Please select at least one section');
        sectionSelect.focus();
        return false;
    }
});
</script>
@endsection

