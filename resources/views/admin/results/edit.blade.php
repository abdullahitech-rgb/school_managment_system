@extends('layouts.admin')

@section('title', 'Edit Result')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 d-inline-block">Edit Result</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Result Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.results.update', $result->id) }}" method="POST" id="resultForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="student_id" class="form-label">Student <span class="text-danger">*</span></label>
                                    <select class="form-select @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                                        <option value="">Select Student</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}" {{ old('student_id', $result->student_id) == $student->id ? 'selected' : '' }}>
                                                {{ $student->name }} ({{ $student->admission_no }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exam_id" class="form-label">Exam <span class="text-danger">*</span></label>
                                    <select class="form-select @error('exam_id') is-invalid @enderror" id="exam_id" name="exam_id" required>
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}" {{ old('exam_id', $result->exam_id) == $exam->id ? 'selected' : '' }}>
                                                {{ $exam->class?->name }} - {{ $exam->exam_date ? \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') : '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('exam_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subject_id" class="form-label">Subject <span class="text-danger">*</span></label>
                                    <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ old('subject_id', $result->subject_id) == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->name }} ({{ $subject->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="marks" class="form-label">Marks <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('marks') is-invalid @enderror" id="marks" name="marks" value="{{ old('marks', $result->marks) }}" max="100" step="0.01" required>
                                    @error('marks')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="percentage" class="form-label">Percentage (%)</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage" value="{{ old('percentage', $result->percentage) }}" step="0.01" readonly>
                                    <small class="text-muted">Auto-calculated from marks</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="grade" class="form-label">Grade</label>
                                    <input type="text" class="form-control" id="grade" name="grade" value="{{ old('grade', $result->grade) }}" readonly>
                                    <small class="text-muted">Auto-calculated from percentage</small>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Grading Scale:</strong> A: 80-100 | B: 60-79 | C: 40-59 | D: 0-39
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Result
                            </button>
                            <a href="{{ route('admin.results.index') }}" class="btn btn-outline-secondary">
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
document.getElementById('marks').addEventListener('change', function() {
    const marks = parseFloat(this.value) || 0;
    const percentage = (marks / 100) * 100;
    document.getElementById('percentage').value = percentage.toFixed(2);

    let grade = 'D';
    if (percentage >= 80) grade = 'A';
    else if (percentage >= 60) grade = 'B';
    else if (percentage >= 40) grade = 'C';
    document.getElementById('grade').value = grade;
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const marksInput = document.getElementById('marks');
    marksInput.dispatchEvent(new Event('change'));
});
</script>
@endsection
