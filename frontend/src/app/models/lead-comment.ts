export interface LeadComment {
  id: number;
  text: string;
  user_id: number;
  lead_id: number;
  status_id: number;
  comment_value: string;
  is_event: boolean;
  created_at: string;
}
