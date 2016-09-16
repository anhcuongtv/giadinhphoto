ID, Photo Name, Section, File Path, Username, Full Name, Address, City, ZipCode, Country, Round, Total Score, Finish, Score Detail
{foreach item=roundphoto from=$roundPhotos}
{assign var=countrycode value=$roundphoto->poster->country}
{$roundphoto->photo->id},{$roundphoto->photo->name|codau2khongdau},{$roundphoto->photo->sectionName},{$roundphoto->photo->filepath},{$roundphoto->poster->username},{$roundphoto->poster->fullname|codau2khongdau}, {$roundphoto->poster->address|codau2khongdau|replace:',':' '}, {$roundphoto->poster->city}, {$roundphoto->poster->zipcode|codau2khongdau}, {$setting.country.$countrycode}, {$myRound->name|codau2khongdau}, {$roundphoto->totalScore}, {if $roundphoto->isfinished == 1}YES{else}NO{/if}, {foreach item=photopoint from=$roundphoto->photoPointList name=photopointlist}{$photopoint->judger->user->username}({$photopoint->point}){if !$smarty.foreach.photopointlist.last && $roundphoto->photoPointList|@count > 1} | {/if}{/foreach}

{/foreach}