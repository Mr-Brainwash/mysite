<div class="form-group">
    <input name="title" type="text" class="form-control" value="{{old('title') ?? $post->title ?? ''}}">
</div>
<div class="form-group">
    <textarea name="description" class="form-control" rows="8">{{old('description') ?? $post->description ?? ''}}</textarea>
</div>
<div class="form-group">
    <input name="img" type="file" class="form-control-file">
</div>
