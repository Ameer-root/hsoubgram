<input class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl dark:border-gray-700 dark:outline-none dark:bg-gray-900 dark:text-gray-300" name="image" id="file_input" type="file">
<p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or GIF.</p>
<label>
    <textarea name="description" rows="5" class="mt-10 w-full border dark:border-0 border-gray-200 rounded-xl dark:ring-gray-700 dark:focus:ring-indigo-600 dark:bg-gray-900 dark:text-gray-300" placeholder="{{__('Write a description...')}}">
        {{$post->description ?? ''}}
    </textarea>
</label>
