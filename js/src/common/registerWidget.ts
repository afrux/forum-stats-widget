import Application from "flarum/common/Application";
import Widgets from 'flarum/extensions/afrux-forum-widgets-core/common/extend/Widgets';

import ForumStatsWidget from './components/ForumStatsWidget';

export default function(app: Application) {
  (new Widgets).add({
    key: 'forumStats',
    component: ForumStatsWidget,
    isDisabled: false,
    isUnique: true,
    placement: 'end',
    position: 2,
  }).extend(app, 'afrux-forum-stats-widget');
};
