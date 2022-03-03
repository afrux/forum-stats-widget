import app from 'flarum/common/app';
import Tooltip from 'flarum/common/components/Tooltip';
import icon from 'flarum/common/helpers/icon';
import Widget from 'flarum/extensions/afrux-forum-widgets-core/common/components/Widget';
import extractText from 'flarum/common/utils/extractText';

export default class ForumStatsWidgetWidget extends Widget {
  className(): string {
    return 'Afrux-ForumStatsWidgetWidget';
  }

  icon(): string {
    return 'fas fa-chart-pie';
  }

  title(): string {
    return extractText(app.translator.trans('afrux-forum-stats-widget.forum.widget.title'));
  }

  content() {
    const stats = app.forum.attribute('afrux-forum-stats-widget.stats');

    return (
      <div className="Afrux-ForumStatsWidget-grid">
        {Object.keys(stats).map((stat) => (
          <Tooltip text={stats[stat].label}>
            <span className="Afrux-ForumStatsWidget-grid-item">
              <span className="Afrux-ForumStatsWidget-grid-item-icon">{icon(stats[stat].icon)}</span>
              <span className="Afrux-ForumStatsWidget-grid-item-value">{stats[stat].prettyValue}</span>
            </span>
          </Tooltip>
        ))}
      </div>
    );
  }
}
