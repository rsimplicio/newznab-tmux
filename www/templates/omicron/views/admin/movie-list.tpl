<h1>{$page->title}</h1>

{if $movielist}

<div style="float:right;">

	<form name="moviesearch" action="">
		<label for="moviename">Title</label>
		<input id="moviename" type="text" name="moviename" value="{$moviename}" size="15" />
		&nbsp;&nbsp;
		<input type="submit" value="Go" />
	</form>
</div>

{$pager}

<br/><br/>

<table style="width:100%;margin-top:10px;" class="data Sortable highlight">

	<tr>
		<th>IMDB id</th>
		<th>TMDb id</th>
		<th>Title</th>
		<th class="mid">Cover</th>
		<th class="mid">Backdrop</th>
		<th class="mid" style="width:80px;">Created</th>
		<th style="width:100px;" class="mid">options</th>
	</tr>

	{foreach from=$movielist item=movie}
	<tr class="{cycle values=",alt"}">
		<td class="less"><a href="http://www.imdb.com/title/tt{$movie.imdbid}" title="View in IMDB">{$movie.imdbid}</a></td>
		<td class="less"><a href="http://www.themoviedb.org/movie/{$movie.tmdbid}" title="View in TMDb">{$movie.tmdbid}</a></td>
		<td><a title="Edit" href="{$smarty.const.WWW_TOP}/movie-edit.php?id={$movie.imdbid}">{$movie.title} ({$movie.year})</a></td>
		<td class="less mid">{if $movie.cover == "1"}Yes{else}No{/if}</td>
		<td class="less mid">{if $movie.backdrop == "1"}Yes{else}No{/if}</td>
		<td class="less mid">{$movie.createddate|date_format}</td>
		<td class="mid">
			<a title="update" href="{$smarty.const.WWW_TOP}/movie-add.php?id={$movie.imdbid}&amp;update=1">update</a> |
			<a title="delete" href="{$smarty.const.WWW_TOP}/movie-delete.php?id={$movie.imdbid}">delete</a>
		</td>
	</tr>
	{/foreach}

</table>
    <br/>
    {$pager}
{else}
<p>No Movies available.</p>
{/if}