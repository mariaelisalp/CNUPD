@props(['url'])
<tr>
<td class="header">
<a href="http://localhost:8000" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('logo.png')}}" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
