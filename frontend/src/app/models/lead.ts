import { Source } from "./source";
import { Unit } from "./unit";
import { Status } from "./status";

export class Lead {
  id: number;
  link: string;
  phone: string;
  source_id: number;
  unit_id: number;
  user_id: number;
  is_processed: boolean;
  is_express_delivery: boolean;
  is_quality_lead: boolean;
  is_add_sale: boolean;
  status_id: number;
  count_create: number;
  created_at: string;
  created_at_time: number;
  lastComment: string;
  author: string;
  source: Source;
  unit: Unit;
  status: Status;
}
