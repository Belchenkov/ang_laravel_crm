import { Source } from "./source";
import { Unit } from "./unit";
import { Status } from "./status";

export class Task {
  id: number;
  link: string;
  phone: string;
  source_id: number;
  unit_id: number;
  user_id: number;
  status_id: boolean;
  count_create: number;
  created_at: string;
  responsible_id: number;
  source: Source;
  unit: Unit;
  status: Status;
}
