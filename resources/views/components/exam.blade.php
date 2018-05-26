@if($exam->is_after)
    <h6>培训后分数</h6>
@elseif($exam->is_before)
    <h6>培训前分数</h6>
@endif
<p>
    @if($exam->type == 'toefl')
        TOEFL:
        <span class="badge badge-pill badge-primary">阅读</span> {{ $exam->score['reading'] }}
        <span class="badge badge-pill badge-secondary">听力</span> {{ $exam->score['listening'] }}
        <span class="badge badge-pill badge-success">口语</span> {{ $exam->score['speaking'] }}
        <span class="badge badge-pill badge-danger">写作</span> {{ $exam->score['writing'] }}
    @elseif($exam->type == 'ielts')
        IELTS:
        <span class="badge badge-pill badge-primary">阅读</span> {{ floatval($exam->score['reading']) / 2 }}
        <span class="badge badge-pill badge-secondary">听力</span> {{ floatval($exam->score['listening']) / 2 }}
        <span class="badge badge-pill badge-success">口语</span> {{ floatval($exam->score['speaking']) / 2 }}
        <span class="badge badge-pill badge-danger">写作</span> {{ floatval($exam->score['writing']) / 2 }}
    @elseif($exam->type == 'sat')
        SAT:
        <span class="badge badge-pill badge-primary">阅读</span> {{ $exam->score['reading'] }}
        <span class="badge badge-pill badge-secondary">语法</span> {{ $exam->score['writing'] }}
        <span class="badge badge-pill badge-success">数学</span> {{ $exam->score['math'] }}
        <span class="badge badge-pill badge-danger">写作</span> {{ implode($exam->score['essay']) }}
    @elseif($exam->type == 'act')
        ACT:
        <span class="badge badge-pill badge-primary">阅读</span> {{ $exam->score['reading'] }}
        <span class="badge badge-pill badge-secondary">英语</span> {{ $exam->score['english'] }}
        <span class="badge badge-pill badge-success">数学</span> {{ $exam->score['math'] }}
        <span class="badge badge-pill badge-danger">科学</span> {{ $exam->score['science'] }}
    @elseif($exam->type == 'sat2')
        SAT II:
        <span class="badge badge-pill badge-primary">{{ $exam->score['subject'] }}</span> {{ $exam->score['score'] }}
    @elseif($exam->type == 'ap')
        AP:
        <span class="badge badge-pill badge-primary">{{ $exam->score['subject'] }}</span> {{ $exam->score['score'] }}
    @endif
</p>