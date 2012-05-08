CREATE TABLE tu_insight_baselines (
  date date NOT NULL COMMENT 'Date of baseline statistic.',
  instance_id int(11) NOT NULL COMMENT 'Instance ID.',
  slug varchar(100) NOT NULL COMMENT 'Unique identifier for a type of statistic.',
  value int(11) NOT NULL COMMENT 'The numeric value of this stat/total/average.',
  UNIQUE KEY unique_base (date,instance_id,slug),
  KEY date (date,instance_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci COMMENT='Insight baseline statistics.';

CREATE TABLE  tu_insights (
id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT  'Internal unique ID.',
instance_id INT( 11 ) NOT NULL COMMENT  'Instance ID.',
slug VARCHAR( 100 ) NOT NULL COMMENT  'Identifier for a type of statistic.',
text VARCHAR( 255 ) NOT NULL COMMENT  'Text content of the alert.',
post_key INT( 11 ) NULL COMMENT  'Internal post ID.',
date DATE NOT NULL COMMENT  'Date of insight.',
INDEX (  instance_id ,  slug ,  post_key ,  date )
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT =  'Insights for a given service user.';

